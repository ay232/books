<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookController;
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

//email: test@test.ru
//password: 123123123
Route::get('login',[AuthController::class,'login'])->name('auth.login');

//page = page number
//perpage
Route::middleware('auth:sanctum')->group(function (){
    Route::get('authors',[AuthorController::class,'index'])->name('authors.list')->middleware('auth:sanctum');
//search by: first_name, last_name
    Route::get('authors/search',[AuthorController::class,'search'])->name('authors.search');
    Route::get('authors/{id}',[AuthorController::class,'show'])->name('authors.show');
//Route::post('authors',[AuthorController::class,'create'])->name('author.create');
    Route::post('authors',[AuthorController::class,'create'])->name('author.create');
    Route::patch('authors/{id}',[AuthorController::class,'update'])->name('author.update');
    Route::delete('authors/{id}',[AuthorController::class,'delete'])->name('author.delete');

//page = page number
//perpage
    Route::get('books',[BookController::class,'index'])->name('books.list');
//search by: name, description
    Route::get('books/search',[BookController::class,'search'])->name('books.search');
    Route::get('books/{id}',[BookController::class,'show'])->name('books.show');
    Route::post('books',[BookController::class,'create'])->name('book.create');
    Route::patch('books/{id}',[BookController::class,'update'])->name('book.update');
    Route::delete('books/{id}',[BookController::class,'delete'])->name('book.delete');
});
