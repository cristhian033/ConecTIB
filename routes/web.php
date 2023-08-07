<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartmentsController;

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
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', [PostsController::class, 'index'])->name('posts.index');
    Route::get('/UsersApi', [PostsController::class, 'getUsersPosts'])->name('posts.users');
    Route::get('/user/{id?}', [PostsController::class, 'getPosts'])->name('posts.getPosts');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/getDepartments/{id?}', [DepartmentsController::class, 'load'])->name('departments.get');
    Route::get('/getCities/{id?}', [CitiesController::class, 'load'])->name('cities.get');
});

require __DIR__.'/auth.php';
