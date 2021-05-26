<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('web');

Route::get('/signup', [RegisterController::class, 'index'])->name('signup');
Route::post('/signup', [RegisterController::class, 'register'])->middleware('web');

Route::prefix('unittest')->group(function () {
    Route::get('/users', [TestController::class, 'users']);
    Route::get('/usersActivity', [TestController::class, 'usersActivity']);
    Route::get('/usersCreditHistory', [TestController::class, 'usersCreditHistory']);
    Route::get('/usersFinance', [TestController::class, 'usersFinance']);
    Route::get('/usersRating', [TestController::class, 'usersRating']);
    Route::get('/usersAdviceQuery', [TestController::class, 'usersAdviceQuery']);
});

/*Route::get('/', function () {
    return view('welcome');
});*/
