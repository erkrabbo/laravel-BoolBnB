<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/user/logged', 'Api\UserController@logged');
// Route::get('/home', 'Api\HouseController@home');
Route::get('/houses/sponsored', 'Api\HouseController@sponsored');
Route::get('/houses/last', 'Api\HouseController@last');
Route::get('/houses/search', 'Api\HouseController@search');
// Route::get('/user/liked', 'Api\HouseController@liked');
