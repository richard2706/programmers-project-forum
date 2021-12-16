<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
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

Route::get('/posts', [PostController::class, 'index'])
    ->middleware(['auth'])->name('home');

Route::get('/posts/newpost', [PostController::class, 'create'])
    ->middleware(['auth'])->name('posts.create');

Route::post('/posts', [PostController::class, 'store'])
    ->middleware(['auth'])->name('posts.store');

Route::get('/posts/{post}', [PostController::class, 'show'])
    ->middleware(['auth'])->name('posts.show');

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])
    ->middleware(['auth'])->name('posts.edit');

Route::post('/posts/{post}/update', [PostController::class, 'update'])
    ->middleware(['auth'])->name('posts.update');

Route::get('/posts/{post}/newcomment', [CommentController::class, 'create'])
    ->middleware(['auth'])->name('comments.create');

Route::post('/posts/{post}', [CommentController::class, 'store'])
    ->middleware(['auth'])->name('comments.store');

Route::get('/posts/{post}/comment/{comment}/edit', [CommentController::class, 'edit'])
    ->middleware(['auth'])->name('comments.edit');

Route::post('/posts/{post}/comment/{comment}/update', [CommentController::class, 'update'])
    ->middleware(['auth'])->name('comments.update');

Route::delete('/posts/{post}/comment/{comment}/delete', [CommentController::class, 'destroy'])
    ->middleware(['auth'])->name('comments.destroy');

require __DIR__.'/auth.php';
