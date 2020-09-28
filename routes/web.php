<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('post', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
Route::post('post', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
Route::get('/post-show/{id}', [App\Http\Controllers\PostController::class, 'show'])->name('post.show');
Route::post('/comment/store', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');

