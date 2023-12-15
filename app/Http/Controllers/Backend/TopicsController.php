<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TopicsModel;

class TopicsController extends Controller
{
    public function viewTopics()
    {
        $topics = TopicsModel::latest()->get();
        return view('backend.topics.view_topics', compact('topics'));
    }
    public function addTopic()
    {

        return view('backend.topics.add_topic');
    }
    public function storeTopic(Request $request)
    {
        $request->validate([
            'topic_name' => 'required|unique:topics|max:100',
        ]);

        TopicsModel::insert([
            'topic_name' => $request->topic_name,
            'topic_description' => $request->topic_description

        ]);

        $notification = array(
            'message' => 'Topic Create Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('view.topics')->with($notification);
    }

    public function updateTopic(Request $request)
    {
        $pid = $request->id;
        TopicsModel::findOrFail($pid)->update([
            'topic_name' => $request->topic_name,
            'topic_description' => $request->topic_description

        ]);

        $notification = array(
            'message' => 'Topic Edit Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('view.topics')->with($notification);
    }

    public function editTopic($id)
    {
        $topic = TopicsModel::findOrFail($id);
        return view('backend.topics.edit_topic', compact('topic'));
    }
    public function deleteTopic($id)
    {
        TopicsModel::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Topic Delete Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
