<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        
        return view('admin.index');
    }

    public function adminLogOut(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function adminLogin()
    {
        return view('admin.login');
    }

    public function adminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('admin.profile_view', compact('profileData'));
    }

    public function adminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->bio = $request->bio;
        $data->email = $request->email;

        if ($request->file('photo')) {
           $file = $request->file('photo');
           @unlink(public_path('upload/admin_images/' . $data->photo));
           $filename = date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/admin_images'),$filename);
           $data['photo']= $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Admin profile Updated Succesfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function adminChangepassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.change_password',compact('profileData'));
    }

    public function adminUpdatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            $notification = array(
                'message' => 'Old Password Does not Match!',
                'alert-type' => 'error'
            );

        return back()->with($notification);
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password Change Successfully!',
            'alert-type' => 'success'
        );

        return back()->with($notification);

    }
}
