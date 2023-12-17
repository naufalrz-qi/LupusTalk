<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PostsModel;
use App\Models\TopicsModel;
use App\Models\GameCategories;


class PostsController extends Controller
{
    public function viewPosts()
    {
        $posts = PostsModel::latest()->with('topics','category','user')->get();
        return view('backend.posts.view_posts', compact('posts'));
    }
    public function addPost()
    {
        $topics = TopicsModel::all();
        $categories = GameCategories::all();

        return view('backend.posts.add_post', compact('topics', 'categories'));
    }
    public function storePost(Request $request)
    {
        $request->validate([
            'cat_id' => 'required',
            'post_title' => 'required',
            'post_content' => 'required',
            'topics' => 'required|array|max:3',
        ]);

        $photo = '';
        if ($request->file('post_photo')) {
            $file = $request->file('post_photo');
            @unlink(public_path('upload/admin_images/posts/' . $request->post_photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images/posts/'),$filename);
            $photo=$filename;
         }

        $post = PostsModel::create([
            'cat_id' => $request->cat_id,
            'post_title' => $request->post_title,
            'post_content' => $request->post_content,
            'post_photo' => $photo,
            'post_by' => Auth::user()->id,

        ]);

        $post->topics()->sync($request->topics);

        $notification = array(
            'message' => 'Post Create Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('view.posts')->with($notification);
    }

    public function updatePost(Request $request)
    {
        $pid = $request->id;
        PostsModel::findOrFail($pid)->update([
            'post_title' => $request->post_title,
            'post_description' => $request->post_description

        ]);

        $notification = array(
            'message' => 'Post Edit Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('view.posts')->with($notification);
    }

    public function editPost($id)
    {
        $post = PostsModel::findOrFail($id);
        return view('backend.posts.edit_post', compact('post'));
    }
    public function deletePost($id)
    {
        PostsModel::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Post Delete Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
