<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', [\App\Http\Controllers\API\HomeController::class, 'index']);
Route::get('/category/post/{id}', [\App\Http\Controllers\API\HomeController::class, 'showCategoryPosts']);
Route::get('/category/posts', [\App\Http\Controllers\API\HomeController::class, 'showRandomCategories']);
Route::get('/latest/posts', [\App\Http\Controllers\API\HomeController::class, 'latestPosts']);
Route::get('/search/posts', [\App\Http\Controllers\API\HomeController::class, 'searchPosts']);

// auth routes
Route::middleware(['auth'])->group(function () {
    Route::resource('/user/posts', \App\Http\Controllers\API\UserPostController::class);
    Route::post('/user/post/comments', [\App\Http\Controllers\API\UserPostCommentController::class, 'store']);
    Route::delete('/user/post/comments/{id}', [\App\Http\Controllers\API\UserPostCommentController::class, 'destroy']);
    Route::post('/user/post/comment/votes', [\App\Http\Controllers\API\UserPostCommentVoteController::class, 'store']);
    Route::delete('/user/post/comment/votes/{id}', [\App\Http\Controllers\API\UserPostCommentVoteController::class, 'destory']);
});
