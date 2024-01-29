<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrendPostController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {

    Route::prefix('admin')->group(function(){
        //Profile
        Route::get('/profile', [ProfileController::class, 'profile'])->name('admin#profile');
        Route::post('/profile/update', [ProfileController::class, 'updateBtn'])->name('admin#profileUpdateBtn');

        //Password
        Route::get('/change/password', [ProfileController::class, 'changePassBtn'])->name('admin#changePassword');
        Route::post('/update/password', [ProfileController::class, 'updatePassBtn'])->name('admin#updatePassword');

       //Admin List
        Route::get('/list', [ListController::class, 'list'])->name('admin#list');
        Route::get('/account/delete/{id}', [ListController::class, 'delete'])->name('admin#delete');

        //Category
        Route::get('/category/list', [CategoryController::class, 'categoryList'])->name('admin#categoryList');
        Route::get('/category/create', [CategoryController::class, 'categoryCreate'])->name('admin#createCategory');
        Route::post('/category/create', [CategoryController::class, 'categoryCreateBtn'])->name('admin#categoryCreateBtn');
        Route::get('/category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('admin#deleteCategory');
        Route::get('/category/edit/{id}', [CategoryController::class, 'editCategory'])->name('admin#editCategory');
        Route::post('/category/update/{id}', [CategoryController::class, 'categoryUpdateBtn'])->name('admin#categoryUpdateBtn');

        //Post
        Route::get('/post/list', [PostController::class, 'postList'])->name('admin#postList');
        Route::get('post/create', [PostController::class, 'createPost'])->name('admin#createPost');
        Route::post('/post/create', [PostController::class, 'postCreateBtn'])->name('admin#postCreateBtn');
        Route::get('/post/delete/{id}', [PostController::class, 'postDelete'])->name('admin#deletePost');
        Route::get('/post/edit/{id}', [PostController::class, 'postEdit'])->name('admin#editPost');
        Route::get('/post/delete/photo/{id}', [PostController::class, 'photoDelete'])->name('admin#deletePhoto');
        Route::post('/post/update/{id}', [PostController::class, 'postUpdate'])->name('admin#postUpdate');
        Route::get('/post/details/{id}', [PostController::class, 'viewPost'])->name('admin#postDetails');

        //Trend Post
        Route::get('/trendPost', [TrendPostController::class, 'trendPost'])->name('admin#trendPost');
    });

});
