<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    public function viewAnswers()
    {
        $answers = AnswersModel::with('topics','category','user')->get();
        return view('backend.answers.view_answers', compact('answers'));
    }
    public function detailAnswer($id)
    {

        $answer = AnswersModel::with('topics','category','user')->find($id);

        return view('backend.answers.detail_answer', compact('answer'));
    }
    public function addAnswer()
    {
        $topics = TopicsModel::all();
        $categories = GameCategories::all();

        return view('backend.answers.add_answer', compact('topics', 'categories'));
    }
    public function storeAnswer(Request $request)
    {
        $request->validate([
            'cat_id' => 'required',
            'answer_title' => 'required',
            'answer_content' => 'required',
            'topics' => 'required|array|max:3',
        ]);

        $photo = '';
        if ($request->file('answer_photo')) {
            $file = $request->file('answer_photo');
            @unlink(public_path('upload/admin_images/answers/' . $request->answer_photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images/answers/'),$filename);
            $photo=$filename;
         }

        $answer = AnswersModel::create([
            'cat_id' => $request->cat_id,
            'answer_title' => $request->answer_title,
            'answer_content' => $request->answer_content,
            'answer_photo' => $photo,
            'answer_by' => Auth::user()->id,

        ]);

        $answer->topics()->sync($request->topics);

        $notification = array(
            'message' => 'Answer Create Successfully!',
            'alert-type' => 'success'
        );

        if (Auth::user()->role === 'admin') {
            return redirect()->route('view.answers')->with($notification);
        }else{
            return redirect()->route('dashboard')->with($notification);
        }
    }

    public function updateAnswer(Request $request)
    {
        $pid = $request->id;
        $answer = AnswersModel::findOrFail($pid);
        if ($answer->answer_by === Auth::user()->id) {
        $request->validate([
            'cat_id' => 'required',
            'answer_title' => 'required',
            'answer_content' => 'required',
            'topics' => 'required|array|max:3',
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


        $answer->cat_id = $request->cat_id;
        $answer->answer_title = $request->answer_title;
        $answer->answer_content = $request->answer_content;
        $answer->answer_photo = $photo;
        $answer->answer_by = Auth::user()->id;


        $answer->save();


        $answer->topics()->sync($request->topics);

        $notification = array(
            'message' => 'Answer Edit Successfully!',
            'alert-type' => 'success'
        );

        if (Auth::user()->role === 'admin') {
            return redirect()->route('view.answers')->with($notification);
        }else{
            return redirect()->route('dashboard')->with($notification);
        }
    }else{
        $notification = array(
            'message' => 'You do not have permission!',
            'alert-type' => 'Error'

        );
        return redirect()->route('dashboard')->with($notification);

    }
    }

    public function editAnswer($id)
    {

        $answer = AnswersModel::findOrFail($id);
        $categories = GameCategories::all();
        $topics = TopicsModel::all();
        if ($answer->answer_by === Auth::user()->id) {
            return view('backend.answers.edit_answer', compact('answer', 'categories', 'topics'));
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
