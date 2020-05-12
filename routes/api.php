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



Route::group(['prefix' => 'auth'], function () {

    Route::post('login','Api\Auth\AuthorizationController@login');
    Route::post('registration','Api\Auth\AuthorizationController@registration');

    Route::group([
        'middleware' => 'auth:api'
      ], function() {
        Route::post('logout', 'Api\Auth\AuthorizationController@logout');
    });
});

Route::group([
    'middleware'=> 'auth:api'
],function () {
    Route::get('/user', 'Api\Crm\DashboardController@index');
});