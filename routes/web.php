<?php

use App\Http\Controllers\backend\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\IndexController;
use App\Http\Controllers\backend\LoginController;
use App\Http\Controllers\backend\PostController;
use App\Models\Category;

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

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// login Controller
Route::prefix('admin-backend')->group(function () {
    Route::get('login', [LoginController::class, 'getLoginform'])->name('getLoginForm');
    Route::post('login', [LoginController::class,'postLogin'])->name('postLogin');
    Route::get('logout', [LoginController::class, 'getLogout'])->name('getLogout');
});

Route::group(['prefix' => 'admin-backend','middleware' => 'admin'], function () {
    Route::get('index', [IndexController::class, 'index'])->name('index');

    // Category Controller
    Route::get('category-form', [CategoryController::class, 'categoryForm'])->name('categoryForm');
    Route::post('category-form', [CategoryController::class, 'postCategory'])->name('postCategory');
    Route::get('category-form/edit/{id}', [CategoryController::class, 'editCategoryForm'])->name('editCategoryForm');
    Route::post('category-form-edit', [CategoryController::class, 'updateCategory'])->name('updateCategory');
    Route::get('category-listing', [CategoryController::class, 'categoryListing'])->name('categoryListing');

    // Post Controller
    Route::get('post-form', [PostController::class, 'postForm'])->name('postForm');
    Route::post('post-form', [PostController::class, 'postPost'])->name('postPost');
    Route::get('post-listing', [PostController::class, 'postListing'])->name('postListing');
    Route::get('post-form/edit/{id}', [PostController::class, 'postEdit']);
    Route::post('post-form/edit', [PostController::class, 'postUpdate'])->name('postUpdate');
});
