<?php

use App\Http\Controllers\TransactionAttachmentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.app');
});


Route::middleware("guest")->group(function () {
    Route::get('/login', [UserController::class, 'loginForm'])->name("login");
    Route::post('/login', [UserController::class, 'login'])->name("login");
    Route::get('/register', [UserController::class, 'registerForm'])->name("register");
    Route::post('/register', [UserController::class, 'register'])->name("register");
});

Route::any('/logout', [UserController::class, 'logout'])->middleware("auth")->name("logout");

Route::middleware(['auth'])->prefix("transaction")->group(function () {
    Route::get('/list', [TransactionController::class, 'transactionsList'])->name("transaction-list");
    Route::get('/create', [TransactionController::class, 'getForm'])->name("transaction-form");
    Route::post('/create', [TransactionController::class, 'create'])->name("transaction-create");
    Route::post('/change-status/{id}', [TransactionController::class, 'changeStatus'])->name("transaction-change-status");
    Route::get('/attachment/download/{id}', [TransactionAttachmentController::class, 'download'])->name("transaction-attachment-download");
});



