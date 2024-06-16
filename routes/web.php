<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\Pages\HomeController::class, 'index']);
Route::get('/post/{slug}', [App\Http\Controllers\Pages\HomeController::class, 'show']);
Route::get('/category/{id}', [App\Http\Controllers\Pages\HomeController::class, 'categories']);
Route::get('/search', [App\Http\Controllers\Pages\HomeController::class, 'search'])->name('search');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/posts', [App\Http\Controllers\Pages\PostController::class, 'index'])->name('my-posts');
    Route::get('/dashboard/manage/post', [App\Http\Controllers\Pages\PostController::class, 'create'])->name('manage-post');
});
