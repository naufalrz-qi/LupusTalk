<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GameCategories;

class GameCategoriesController extends Controller
{
    public function viewCategories()
    {
        $categories = GameCategories::latest()->get();
        return view('backend.categories.view_categories', compact('categories'));
    }
    public function addCategory()
    {

        return view('backend.categories.add_category');
    }
}
