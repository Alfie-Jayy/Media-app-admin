<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ActionLogController;

//login
Route::post('/user/login', [AuthController::class, 'userLogin']);
//register
Route::post('user/register', [AuthController::class, 'userRegister']);


//get Post
Route::get('/get/post', [PostController::class, 'postList']);
Route::post('/post/detail', [PostController::class, 'postDetails']);
Route::post('search/post', [PostController::class, 'searchPost']);

//get Category
Route::get('/get/category', [CategoryController::class, 'categoryList']);
Route::post('/get/category', [CategoryController::class, 'categoryNav']);

//action Log
Route::post('/post/view', [ActionLogController::class, 'viewCount']);
