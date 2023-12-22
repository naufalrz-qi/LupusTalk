<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AnswersModel;
use App\Models\PostsModel;

class AnswersController extends Controller
{
    public function viewAnswers()
    {
        $answers = AnswersModel::with('post')->get();
        return view('backend.answers.view_answers', compact('answers'));
    }
    public function detailAnswer($id, $post_id)
    {
        $post = PostsModel::with('categories','topic','user')->find($post_id);
        $answer = AnswersModel::with('post')->find($id);
        return view('backend.answers.detail_answer', compact('answer','post'));
    }

    public function storeAnswer(Request $request, $post_id)
    {
        $request->validate([
            'post_id' => 'required',
            'answer_content' => 'required',
        ]);

        $photo = '';
        if ($request->file('answer_photo')) {
            $file = $request->file('answer_photo');
            @unlink(public_path('upload/answers/' . $request->answer_photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/answers/'),$filename);
            $photo=$filename;
         }

        $answer = AnswersModel::create([
            'post_id' => $request->post_id,
            'answer_content' => $request->answer_content,
            'answer_photo' => $photo,
            'answer_by' => Auth::user()->id,

        ]);

        $notification = array(
            'message' => 'Answer has been sent',
            'alert-type' => 'success'
        );

        if (Auth::user()->role === 'admin') {
            return redirect()->route('view.answers')->with($notification);
        }else{
            return redirect()->route('detail.post', $post_id)->with($notification);
        }
    }

    public function updateAnswer(Request $request, $id, $post_id)
    {
        $answer = AnswersModel::findOrFail($id);
        if ($answer->answer_by === Auth::user()->id) {
        $request->validate([
            'post_id' => 'required',
            'answer_content' => 'required',
        ]);


        $photo = '';
        if ($request->file('answer_photo')) {
            if ($request->answer_photo !== $answer->answer_photo) {
                $file = $request->file('answer_photo');
                @unlink(public_path('upload/answers/' . $request->answer_photo));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/answers/'),$filename);
                $photo=$filename;
             }
        }else {
            $photo = $answer->answer_photo;
         }


        $answer->post_id = $post_id;
        $answer->answer_content = $request->answer_content;
        $answer->answer_photo = $photo;
        $answer->answer_by = Auth::user()->id;


        $answer->save();

        $notification = array(
            'message' => 'Answer Edit Successfully!',
            'alert-type' => 'success'
        );

        if (Auth::user()->role === 'admin') {
            return redirect()->route('view.answers')->with($notification);
        }else{
            return redirect()->route('detail.post', $post_id)->with($notification);
        }
    }else{
        $notification = array(
            'message' => 'You do not have permission!',
            'alert-type' => 'Error'

        );
        return redirect()->route('dashboard')->with($notification);

    }
    }

    public function deleteAnswer($id)
    {
        $answer = AnswersModel::findOrFail($id);
        $photo = $answer->answer_photo;
        if ($photo !== null && $photo !== '') {
            if (file_exists(public_path('upload/answers/' . $photo))) {
                unlink(public_path('upload/answers/' . $photo));
            }
        }

        $answer->delete();
        $notification = array(
            'message' => 'Answer Delete Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
