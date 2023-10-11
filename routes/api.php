<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth')->group(function () {
    Route::any('/user/{id}', [UserController::class, 'get_user'])->name('get_user');
    Route::post('/addBook', [BookController::class, 'addBook'])->name('addBook');
    Route::post('/bookData/{id}', [BookController::class, 'bookData'])->name('bookData');
    Route::get('/getBookData/{id}', [BookController::class, 'getBookData'])->name('getBookData');
    Route::post('/editBook', [BookController::class, 'editBook'])->name('editBook');
    Route::get('/deleteData/{id}', [BookController::class, 'deleteData'])->name('deleteData');
    Route::get('/searchData', [BookController::class, 'searchData'])->name('searchData');
    Route::any('/booksFilter', [BookController::class, 'booksFilter'])->name('booksFilter');

    Route::any('/serverBooks', [BookController::class, 'serverBooks'])->name('serverBooks');
    Route::any('/serverBooksFilter', [BookController::class, 'serverBooksFilter'])->name('serverBooksFilter');

});

// Route::any('/user/{id}', [UserController::class, 'get_user'])->name('user')->middleware('auth');


Route::post('/logout', 'AuthController@logout');

Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'check']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/dashboard/{id}', [HomeController::class, 'dashboard'])->name('home');

