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
Route::get('/posts/create', [PostController::class, 'create'])->middleware('myauth');
Route::post('/posts/store', [PostController::class, 'store'])->middleware('myauth');

Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->middleware('myauth');
Route::put('/posts/{id}', [PostController::class, 'update'])->middleware('myauth');
Route::patch('/posts/{id}', [PostController::class, 'update']);

Route::get('/posts/{id}', [PostController::class, 'show']);
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware('myauth');

Route::get('/categories', [CategoryController::class, 'index'])->name('cateogry.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('cateogry.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('cateogry.store');
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('cateogry.edit');
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('cateogry.update');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('cateogry.destroy');

// Route::resource('posts', PostController::class);

Route::get('register', [RegisterController::class, 'create']);
Route::post('register', [RegisterController::class, 'store']);

Route::get('login', [LoginController::class, 'create']);
Route::post('login', [LoginController::class, 'store']);
Route::post('logout', [LoginController::class, 'destroy']);

Route::get('/my_posts', [MyPostController::class, 'index']);