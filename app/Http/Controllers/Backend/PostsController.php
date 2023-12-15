<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PostsModel;

class PostsController extends Controller
{
    public function viewPosts()
    {
        $posts = PostsModel::latest()->get();
        return view('backend.posts.view_posts', compact('posts'));
    }
    public function addPost()
    {

        return view('backend.posts.add_post');
    }
    public function storePost(Request $request)
    {
        $request->validate([
            'post_name' => 'required|unique:posts|max:100',
        ]);

        PostsModel::insert([
            'post_name' => $request->post_name,
            'post_description' => $request->post_description

        ]);

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
            'post_name' => $request->post_name,
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
