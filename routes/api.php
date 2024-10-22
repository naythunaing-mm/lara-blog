<?php

use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user-login', [AuthController::class, 'login'])->name('login');
// Route::get('category-list', [AuthController::class, 'categoryList'])->middleware('auth:sanctum');
Route::post('user-register', [AuthController::class, 'register'])->name('register');
Route::get('post-list', [PostController::class, 'postList']);
Route::post('post-detail', [PostController::class, 'postDetail']);
Route::get('category-list', [CategoryController::class, 'categoryList']);
