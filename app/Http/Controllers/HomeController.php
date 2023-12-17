<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostsModel;

class HomeController extends Controller
{
    public function home()
    {
        $posts = PostsModel::latest()->with('topics','category','user')->get();
        return view('dashboard', compact('posts'));
    }
}
