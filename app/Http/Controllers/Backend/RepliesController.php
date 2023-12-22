<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RepliesModel;
use App\Models\PostsModel;

class RepliesController extends Controller
{
    public function viewReplies()
    {
        $replies = RepliesModel::with('answer')->get();
        return view('backend.replies.view_replies', compact('replies'));
    }
    public function detailReply($id, $post_id)
    {
        $post = PostsModel::with('categories','topic','user')->find($post_id);
        $reply = RepliesModel::with('answer')->find($id);
        return view('backend.replies.detail_reply', compact('reply','post'));
    }

    public function storeReply(Request $request, $answer_id)
    {
        $request->validate([
            'answer_id' => 'required',
            'reply_content' => 'required',
        ]);

        $reply = RepliesModel::create([
            'answer_id' => $answer_id,
            'reply_content' => $request->reply_content,
            'reply_by' => Auth::user()->id,

        ]);

        $notification = array(
            'message' => 'Reply has been sent',
            'alert-type' => 'success'
        );

        if (Auth::user()->role === 'admin') {
            return redirect()->route('view.replies')->with($notification);
        }else{
            return redirect()->route('detail.answer', $answer_id)->with($notification);
        }
    }

    public function updateReply(Request $request, $id, $answer_id)
    {
        $reply = RepliesModel::findOrFail($id);
        if ($reply->reply_by === Auth::user()->id) {
        $request->validate([
            'answer_id' => 'required',
            'reply_content' => 'required',
        ]);


        $reply->answer_id = $answer_id;
        $reply->reply_content = $request->reply_content;
        $reply->reply_by = Auth::user()->id;


        $reply->save();

        $notification = array(
            'message' => 'Reply Edit Successfully!',
            'alert-type' => 'success'
        );

        if (Auth::user()->role === 'admin') {
            return redirect()->route('view.replies')->with($notification);
        }else{
            return redirect()->route('detail.answer', $answer_id)->with($notification);
        }
    }else{
        $notification = array(
            'message' => 'You do not have permission!',
            'alert-type' => 'Error'

        );
        return redirect()->route('dashboard')->with($notification);

    }
    }

    public function deleteReply($id)
    {
        $reply = RepliesModel::findOrFail($id);
        $reply->delete();
        $notification = array(
            'message' => 'Reply Delete Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
