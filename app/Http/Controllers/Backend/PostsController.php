<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PostsModel;
use App\Models\AnswersModel;
use App\Models\RepliesModel;
use App\Models\TopicsModel;
use App\Models\GameCategories;



class PostsController extends Controller
{
    public function viewPosts()
    {
        $posts = PostsModel::with('categories','topic','user')->get();
        return view('backend.posts.view_posts', compact('posts'));
    }
    public function detailPost($id)
    {

        $post = PostsModel::with('categories','topic','user')->find($id);
        $answers = AnswersModel::with('user')->where('post_id', $id)->get();

        return view('backend.posts.detail_post', compact('post','answers'));
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
            'topic_id' => 'required',
            'post_title' => 'required',
            'post_content' => 'required',
            'categories' => 'required|array|max:3',
        ]);

        $photo = '';
        if ($request->file('post_photo')) {
            $file = $request->file('post_photo');
            @unlink(public_path('upload/posts/' . $request->post_photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/posts/'),$filename);
            $photo=$filename;
         }

        $post = PostsModel::create([
            'topic_id' => $request->topic_id,
            'post_title' => $request->post_title,
            'post_content' => $request->post_content,
            'post_photo' => $photo,
            'post_by' => Auth::user()->id,

        ]);

        $post->categories()->sync($request->categories);

        $notification = array(
            'message' => 'Post Create Successfully!',
            'alert-type' => 'success'
        );

        if (Auth::user()->role === 'admin') {
            return redirect()->route('view.posts')->with($notification);
        }else{
            return redirect()->route('dashboard')->with($notification);
        }
    }

    public function updatePost(Request $request)
    {
        $pid = $request->id;
        $post = PostsModel::findOrFail($pid);
        if ($post->post_by === Auth::user()->id) {
        $request->validate([
            'topic_id' => 'required',
            'post_title' => 'required',
            'post_content' => 'required',
            'categories' => 'required|array|max:3',
        ]);


        $photo = '';
        if ($request->file('post_photo')) {
            if ($request->post_photo !== $post->post_photo) {
                $file = $request->file('post_photo');
                @unlink(public_path('upload/posts/' . $request->post_photo));
                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/posts/'),$filename);
                $photo=$filename;
             }
        }else {
            $photo = $post->post_photo;
         }


        $post->topic_id = $request->topic_id;
        $post->post_title = $request->post_title;
        $post->post_content = $request->post_content;
        $post->post_photo = $photo;
        $post->post_by = Auth::user()->id;


        $post->save();


        $post->categories()->sync($request->categories);

        $notification = array(
            'message' => 'Post Edit Successfully!',
            'alert-type' => 'success'
        );

        if (Auth::user()->role === 'admin') {
            return redirect()->route('view.posts')->with($notification);
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

    public function editPost($id)
    {

        $post = PostsModel::findOrFail($id);
        $categories = GameCategories::all();
        $topics = TopicsModel::all();
        if ($post->post_by === Auth::user()->id) {
            return view('backend.posts.edit_post', compact('post', 'categories', 'topics'));
        }else{
            $notification = array(
                'message' => 'You do not have permission!',
                'alert-type' => 'Error'
            );
            return redirect()->route('dashboard')->with($notification);
        }
    }
    public function deletePost($id)
    {
        $post = PostsModel::findOrFail($id);
        $photo = $post->post_photo;
        if ($photo !== null && $photo !== '') {
            if (file_exists(public_path('upload/posts/' . $photo))) {
                unlink(public_path('upload/posts/' . $photo));
            }
        }

        $post->delete();
        $notification = array(
            'message' => 'Post Delete Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
