<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\QueryController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/credit', [CreditController::class, 'credit'])->name('credit')->middleware('auth');
Route::post('/credit', [CreditController::class, 'purchase'])->name('credit')->middleware('auth');
Route::get('/policy', [HomeController::class, 'policy'])->name('policy');

Route::prefix('query')->middleware('auth')->group(function() {
    Route::get('/', [QueryController::class, 'query'])->name('query');

});


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('web');

Route::get('/recover', [LoginController::class, 'recover'])->name('web');
Route::post('/recover', [LoginController::class, 'sendResetEmail'])->middleware('web');

Route::any('/facebook', [LoginController::class, 'facebook']);
Route::any('/google', [LoginController::class, 'google']);
Route::any('/logout', [LoginController::class, 'logout']);

Route::get('/signup', [RegisterController::class, 'index'])->name('signup');
Route::post('/signup', [RegisterController::class, 'register'])->middleware('web');

Route::any('/loginSuccess', [LoginController::class, 'loginSuccess']);
Route::any('/loginFBSuccess', [LoginController::class, 'loginFBSuccess']);

Route::prefix('email')->group(function() {
    Route::any('/verify', [RegisterController::class, 'verifyEmail']);
    Route::any('/confirm', [RegisterController::class, 'confirmEmail']);
});

Route::prefix('unittest')->group(function () {
    Route::get('/', function () {
        return view('test.unittest');
    });
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
