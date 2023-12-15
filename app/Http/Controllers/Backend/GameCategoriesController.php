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
    public function storeCategory(Request $request)
    {
        $request->validate([
            'cat_name' => 'required|unique:categories|max:150',
            'cat_icon' => 'required',
        ]);

        GameCategories::insert([
            'cat_name' => $request->cat_name,
            'cat_icon' => $request->cat_icon,
            'cat_description' => $request->cat_description

        ]);

        $notification = array(
            'message' => 'Category Create Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('view.categories')->with($notification);
    }

    public function updateCategory(Request $request)
    {
        $pid = $request->id;
        GameCategories::findOrFail($pid)->update([
            'cat_name' => $request->cat_name,
            'cat_icon' => $request->cat_icon,
            'cat_description' => $request->cat_description

        ]);

        $notification = array(
            'message' => 'Category Edit Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('view.categories')->with($notification);
    }

    public function editCategory($id)
    {
        $category = GameCategories::findOrFail($id);
        return view('backend.categories.edit_category', compact('category'));
    }
    public function deleteCategory($id)
    {
        GameCategories::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Category Delete Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
