<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\GameCategoriesController;
use App\Http\Controllers\Backend\TopicsController;
use App\Http\Controllers\Backend\PostsController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'home'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'adminLogOut'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'adminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'adminChangepassword'])->name('admin.change_password');
    Route::post('/admin/password/update', [AdminController::class, 'adminUpdatePassword'])->name('admin.password.update');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/profile', [UserController::class, 'userProfile'])->name('user.profile');
    Route::post('/user/profile/store', [UserController::class, 'userProfileStore'])->name('user.profile.store');
    Route::get('/user/change/password', [UserController::class, 'userChangepassword'])->name('user.change_password');
    Route::post('/user/password/update', [UserController::class, 'userUpdatePassword'])->name('user.password.update');
});

Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Game Categories
    Route::controller(GameCategoriesController::class)->group(function () {
        Route::get('/view/categories', 'viewCategories')->name('view.categories');
        Route::get('/add/category', 'addCategory')->name('add.category');
        Route::post('/store/category', 'storeCategory')->name('store.category');
        Route::post('/update/category', 'updateCategory')->name('update.category');
        Route::get('/edit/category/{id}', 'editCategory')->name('edit.category');
        Route::get('/delete/category/{id}', 'deleteCategory')->name('delete.category');

    });
});
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Game Topics
    Route::controller(TopicsController::class)->group(function () {
        Route::get('/view/topics', 'viewTopics')->name('view.topics');
        Route::get('/add/topic', 'addTopic')->name('add.topic');
        Route::post('/store/topic', 'storeTopic')->name('store.topic');
        Route::post('/update/topic', 'updateTopic')->name('update.topic');
        Route::get('/edit/topic/{id}', 'editTopic')->name('edit.topic');
        Route::get('/delete/topic/{id}', 'deleteTopic')->name('delete.topic');

    });
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Game Posts
    Route::controller(PostsController::class)->group(function () {
        Route::get('/view/posts', 'viewPosts')->name('view.posts');
    });
});
Route::middleware(['auth', 'verified'])->group(function () {
    // Game Posts
    Route::controller(PostsController::class)->group(function () {
        Route::get('/add/post', 'addPost')->name('add.post');
        Route::post('/store/post', 'storePost')->name('store.post');
        Route::post('/update/post', 'updatePost')->name('update.post');
        Route::get('/edit/post/{id}', 'editPost')->name('edit.post');
        Route::get('/delete/post/{id}', 'deletePost')->name('delete.post');

    });
});

