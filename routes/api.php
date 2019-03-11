<?php

use Illuminate\Http\Request;

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


Route::post('/auth/login', 'AuthController@login');
Route::post('/auth/logout', 'AuthController@logout');
Route::post('/auth/register', 'AuthController@register');


Route::post('/categories', 'CategoryController@store');
Route::get('/categories', 'CategoryController@index');

Route::get('/revenue-types', 'RevenueTypeController@index');
Route::post('/revenue-types', 'RevenueTypeController@store');
Route::put('/revenue-types/{id}', 'RevenueTypeController@update');
Route::delete('/revenue-types/{id}', 'RevenueTypeController@destroy');

Route::get('/revenues', 'RevenueController@index');
Route::post('/revenues', 'RevenueController@store');
Route::put('/revenues/{id}', 'RevenueController@update');
Route::delete('/revenues/{id}', 'RevenueController@destroy');

Route::get('/expendicture-types', 'ExpendictureTypeController@index');
Route::post('/expendicture-types', 'ExpendictureTypeController@store');
Route::put('/expendicture-types/{id}', 'ExpendictureTypeController@update');
Route::delete('/expendicture-types/{id}', 'ExpendictureTypeController@destroy');

Route::get('/expendictures', 'ExpendictureController@index');
Route::post('/expendictures', 'ExpendictureController@store');
Route::put('/expendictures/{id}', 'ExpendictureController@update');
Route::delete('/expendictures/{id}', 'ExpendictureController@destroy');