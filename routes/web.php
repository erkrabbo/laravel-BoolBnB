<?php

use Illuminate\Support\Facades\Auth;
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
Route::get('/', 'HomeController@index')->name('home');
Route::get('/houses', 'HouseController@index');
Route::resource('/houses', 'HouseController')->only('show');

Auth::routes();

// Route::resource('houses', 'HouseController');


Route::middleware('auth')->group(function () {
    Route::resource('admin/houses', 'HouseController')->except('index','show');
});
