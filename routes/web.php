<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MyPostController;

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

// Route::get('test', function() {
//     \App\Models\Post::factory(3)->create();
// });

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->middleware('myauth')->name('posts.create');
Route::post('/posts/store', [PostController::class, 'store'])->middleware('myauth')->name('posts.store');

Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->middleware('myauth')->name('posts.edit');
Route::put('/posts/{id}', [PostController::class, 'update'])->middleware('myauth')->name('posts.update');
Route::patch('/posts/{id}', [PostController::class, 'update'])->name('posts.update');

Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware('myauth')->name('posts.destroy');

// Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
// Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');
// Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
// Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
// Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('category.update');
// Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

Route::resource('category', CategoryController::class);

// Route::resource('posts', PostController::class);

Route::get('register', [RegisterController::class, 'create'])->name('register.create');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');

Route::get('login', [LoginController::class, 'create'])->name('login.create');
Route::post('login', [LoginController::class, 'store'])->name('login.store');
Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/my_posts', [MyPostController::class, 'index'])->name('my_posts.index');