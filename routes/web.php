<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Comment;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['middleware' => 'isAlreadyLogin'], function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/loginHandle', [UserController::class, 'loginHandle'])->name('loginHandle');
});
Route::group(['middleware' => 'isLogin'], function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    
    // add post
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/add', [PostController::class, 'add'])->name('add');
    Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('post.edit')->middleware('isAdminOrOwner');
    Route::put('/post/{id}/update', [PostController::class, 'update'])->name('post.update')->middleware('isAdminOrOwner');
    Route::delete('/post/{id}/delete', [PostController::class, 'destroy'])->name('post.destroy')->middleware('isAdminOrOwner');
    // comments review
    Route::get('/comments/review', [CommentController::class, 'fetchUnpublishedComments'])->name('comments.review')->middleware('isAdminOrOwner');
    // publish comment route
    Route::put('/comments/{id}/publish', [CommentController::class, 'publishComment'])->name('comments.publish')->middleware('isAdminOrOwner');
    // delete comment route 
    Route::delete('/comment/{id}/destroy', [CommentController::class, 'destroyComment'])->name('comment.destroy')->middleware('isAdminOrOwner');
    // add users
    Route::get('users/create', [UserController::class, 'create'])->name('users.create')->middleware('isOwner');
    Route::post('users/store', [UserController::class, 'store'])->name('users.store')->middleware('isOwner');
    Route::get('/messages', [MessageController::class, 'fetchMessages'])->name('getMessages')->middleware('isAdminOrOwner');
});
Route::get('/', [PostController::class, 'fetchPosts'])->name('posts');
// Route::get('/posts', [PostController::class, 'fetchPosts'])->name('posts');
Route::get('/post/{id}', [PostController::class, 'fetchPost'])->name('post');
// delete post
// add comment
Route::post('comment/{id}/add', [CommentController::class, 'store'])->name('comment.add');






// Message
Route::post('messages/send', [MessageController::class, 'send'])->name('sendMessage');