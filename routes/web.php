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

Route::get('/home', [PostController::class, 'index'])
    ->middleware(['auth'])->name('home');

Route::get('/home/posts/newpost', [PostController::class, 'create'])
    ->middleware(['auth'])->name('posts.create');

Route::post('/home', [PostController::class, 'store'])
    ->middleware(['auth'])->name('posts.store');

Route::get('/home/posts/{post}', [PostController::class, 'show'])
    ->middleware(['auth'])->name('posts.show');

Route::get('home/posts/{post}/edit', [PostController::class, 'edit'])
    ->middleware(['auth'])->name('posts.edit');

Route::post('/home/posts/{post}/update', [PostController::class, 'update'])
    ->middleware(['auth'])->name('posts.update');

Route::get('/home/posts/{post}/newcomment', [CommentController::class, 'create'])
    ->middleware(['auth'])->name('comments.create');

Route::post('/home/posts/{post}', [CommentController::class, 'store'])
    ->middleware(['auth'])->name('comments.store');

require __DIR__.'/auth.php';
