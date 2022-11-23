<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Resources\Views\Posts\Show;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\IsAdmin;
use resources\views\admin\dashboard;
use App\Http\Controllers\Admin\DashboardController;

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

Route::get('/', [WelcomeController::class, 'index'])->name('welcome'); 

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//POST
Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{postId}show', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/all', [HomeController::class, 'allPosts'])->name('posts.all');
Route::get('/posts/{postsID}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::post('/posts/{postID}/update', [PostController::class, 'update'])->name('posts.update');
Route::get('/posts/{postID}/delete', [PostController::class, 'delete'])->name('posts.delete');

//Admin routes
Route::get('admin/dashboard', [DashboardController::class, 'index'])->middleware('admin')->name('admin.dashboard');
