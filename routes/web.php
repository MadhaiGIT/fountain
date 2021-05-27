<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/query', [HomeController::class, 'query'])->name('query')->middleware('auth');
Route::get('/credit', [HomeController::class, 'credit'])->name('credit')->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('web');
Route::any('/facebook', [LoginController::class, 'facebook']);
Route::any('/google', [LoginController::class, 'google']);
Route::any('/logout', [LoginController::class, 'logout']);

Route::get('/signup', [RegisterController::class, 'index'])->name('signup');
Route::post('/signup', [RegisterController::class, 'register'])->middleware('web');

Route::any('/loginSuccess', [LoginController::class, 'loginSuccess']);

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
