<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

// Route::get('/posts', [PostController::class, 'index']);
// Route::get('/posts/create', [PostController::class, 'create']);
// Route::post('/posts/store', [PostController::class, 'store']);

// Route::get('/posts/edit/{id}', [PostController::class, 'edit']);
// Route::put('/posts/update/{id}', [PostController::class, 'update']);

// Route::get('/posts/show/{id}', [PostController::class, 'show']);
// Route::delete('/posts/delete/{id}', [PostController::class, 'destroy']);

Route::resource('posts', PostController::class);
