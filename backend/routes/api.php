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

Route::post('auth/register', 'AuthController@register');

Route::get('enquete', 'EnqueteController@getEnquete');
Route::post('enquete', 'EnqueteController@answer');

Route::group(['prefix' => 'result'], function () {
    Route::get('/', 'ResultController@getScore');
    Route::get('graph', 'ResultController@getGraph');
});

Route::group(['prefix' => 'question'], function () {
    Route::post('result', 'ResultController@create');
});
