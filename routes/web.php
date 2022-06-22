<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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
// Route::get('/', 'HomeController@index')->name('home');
Route::resource('/houses', 'HouseController')->only('show');

Auth::routes();
Route::get('/', 'HouseController@home')->name('home');
Route::get('/search', 'HouseController@index');
Route::middleware('auth')->group(function () {
    Route::resource('admin/houses', 'HouseController')->except('index','show');
    Route::resource('admin/houses-image', 'HouseImageController')->only('destroy');
    Route::get('/admin/houses/indexUser', 'HouseController@indexUser')->name('houses.indexUser');
});
