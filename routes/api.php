<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
/*
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//auth Routes
Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);

//post routes
Route::post('/posts',[PostController::class,'addPost']);//create post
Route::get('/posts',[PostController::class,'allPost']);//get all post
Route::delete('/posts/{id}',[PostController::class,'deletePost']);//delete post 
Route::get('/post/{id}',[PostController::class,'singlePost']);//get single post
Route::put('/post/{id}',[PostController::class,'updatePost']);//update post
Route::get('/posts/{id}',[PostController::class,'usersPost']);//get users Post

//comments route
Route::get('/comments/{id}',[CommentController::class,'comments']);//get comment
Route::post('/comment',[CommentController::class,'addComment']);//add comment

//user Routes
Route::get('/users',[UserController::class,'users']);//get all user
Route::get('/user/{id}',[UserController::class,'user']);//get single user