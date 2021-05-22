<?php

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


Route::prefix('unittest')->group(function () {
    Route::get('/users', 'App\Http\Controllers\TestController@users')->name('users');
    Route::get('/usersActivity', 'App\Http\Controllers\TestController@usersActivity')->name('users');
    Route::get('/usersCreditHistory', 'App\Http\Controllers\TestController@usersCreditHistory')->name('users');
    Route::get('/usersFinance', 'App\Http\Controllers\TestController@usersFinance')->name('users');
    Route::get('/usersRating', 'App\Http\Controllers\TestController@usersRating')->name('users');
    Route::get('/usersAdviceQuery', 'App\Http\Controllers\TestController@usersAdviceQuery')->name('users');
});

Route::get('/', function () {
    return view('welcome');
});
