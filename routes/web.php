<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('front/index');
});

Auth::routes();

// Route::get('/{anypath}', [App\Http\Controllers\HomeController::class, 'index'])->where('path','.*');


Route::get('/sidebar/categories', [App\Http\Controllers\BlogController::class, 'allCategories'])->name('sidebar.categories');
Route::get('/blogs', [App\Http\Controllers\BlogController::class, 'index'])->name('blogs');
Route::get('/blog/{blogId}', [App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');
Route::get('/search', [App\Http\Controllers\BlogController::class, 'searchResult'])->name('search.result');
Route::get('/latestblogs', [App\Http\Controllers\BlogController::class, 'getLatestBlogs'])->name('latest.blogs');
Route::get('/frontcategories/{catId}', [App\Http\Controllers\BlogController::class, 'getAllPostsByCatId']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware'=>['auth']], function(){
    Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');
    Route::post('/category/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/delete/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('category.delete');
    Route::get('/delete/selected/categories/{ids}', [App\Http\Controllers\CategoryController::class, 'deleteSelectedCategories'])->name('categories.delete');
    Route::get('/category/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');

    Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
    Route::post('/post/store', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    Route::get('/post/delete/{id}', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.delete');
    Route::get('/post/edit/{id}', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
    Route::post('/post/update/{id}', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');
});


