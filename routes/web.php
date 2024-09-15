<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublishersController;
use App\Http\Controllers\UsersController;


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
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rotas para Books
Route::resource('books', BookController::class);

// Rotas para Authors
Route::resource('authors', AuthorController::class);

// Rotas para Categories
Route::resource('categories', CategoryController::class);

// Rotas para Publishers
Route::resource('publishers', PublishersController::class);
//Rotas para Users
Route::get('/manage/edit', [UsersController::class, 'renderUpdateUserRole'])->name('manage.renderUpdateUserRole');
Route::put('/manage/edit', [UsersController::class, 'updateUserRole'])->name('manage.updateUserRole');
Route::get('/manage/index',[UsersController::class, 'index'])->name('manage.index');
Route::patch('/manage.index/{id}',[UsersController::class, 'demoteUser'])->name('manage.demoteUser');
