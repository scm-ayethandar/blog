<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

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

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/create', [PostController::class, 'create'])->middleware('myauth');
Route::post('/posts/store', [PostController::class, 'store'])->middleware('myauth');

Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->middleware('myauth');
Route::put('/posts/update/{id}', [PostController::class, 'update'])->middleware('myauth');

Route::get('/posts/{id}', [PostController::class, 'show']);
Route::delete('/posts/delete/{id}', [PostController::class, 'destroy'])->middleware('myauth');

// Route::resource('posts', PostController::class);
// Route::get('master', function)
Route::get('register', [RegisterController::class, 'create']);
Route::post('register', [RegisterController::class, 'store']);

Route::get('login', [LoginController::class, 'create']);
Route::post('login', [LoginController::class, 'store']);
Route::post('logout', [LoginController::class, 'destroy']);