<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('logout', 'logout');

});

Route::middleware('auth:api')->group(function () {
    Route::post('posts',[BlogPostController::class,'posts']);
    Route::post('posts/edit/{id}',[BlogPostController::class,'edit']);
    Route::post('posts/delete/{id}',[BlogPostController::class,'delete']);
    Route::post('posts/show',[BlogPostController::class,'show']);

    // Comment Route
    Route::post('comment',[CommentController::class,'comment']);
    Route::post('commentEdit/{id}',[CommentController::class,'commentEdit']);
    Route::post('commentDelete/{id}',[CommentController::class,'commentDelete']);
});

