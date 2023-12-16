<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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
    return view('Home');
});

Route::get('/books', [BookController::class,'index']);
Route::post('/books/add', [BookController::class,'store']);
Route::delete('/books/{book}', [BookController::class,'destroy']);
Route::patch('/books/update/{book}', [BookController::class,'update']);
Route::get('/books/{book}', [BookController::class,'view']);

Route::get('/checkouts', [CheckoutController::class,'index']);
Route::post('/checkouts/add', [CheckoutController::class,'store']);
Route::patch('/checkouts/update/{checkout}', [CheckoutController::class,'update']);
Route::get('/checkouts/viewUpdate/{checkout}/{book}/{student}', [CheckoutController::class,'openUpdate']);
Route::delete('/checkouts/{checkout}', [CheckoutController::class,'destroy']);

Route::get('/students', [StudentController::class,'index']);
Route::delete('/students/{student}', [StudentController::class,'destroy']);
Route::get('/students/{student}', [StudentController::class,'view']);
Route::patch('/students/update/{student}', [StudentController::class,'update']);
Route::post('/students/add', [StudentController::class,'store']);
