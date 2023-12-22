<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostsModel;
use App\Models\AnswersModel;

class HomeController extends Controller
{
    public function home()
    {
        $answers = AnswersModel::latest()->with('user')->take(2)->get();
        $posts = PostsModel::latest()->with('categories','topic','user')->get();
        return view('dashboard', compact('posts', 'answers'));
    }
}
