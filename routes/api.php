<?php

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

    Route::group(['prefix' => 'analytics'], function () {
        Route::get('/bids/all', 'Api\Crm\AnalyticsController@bidsAll');
        Route::get('/bids/progress', 'Api\Crm\AnalyticsController@bidsProgress');
        Route::get('/bids/denied', 'Api\Crm\AnalyticsController@bidsDenied');
        Route::get('/bids/complete', 'Api\Crm\AnalyticsController@bidsComplete');
    });

    Route::group(['prefix' => 'bids'], function () {
        Route::get('/','Api\Crm\BidsController@index');
        Route::post('/','Api\Crm\BidsController@store');
        Route::post('/edit','Api\Crm\BidsController@update');
        Route::post('/delete','Api\Crm\BidsController@delete');
        Route::get('/lastday','Api\Crm\BidsController@bidLastDay');
        Route::post('/lastday','Api\Crm\BidsController@delete');
    });

    Route::group(['prefix' => 'services'], function () {
        Route::get('/','Api\Crm\ServicesController@index');
        Route::post('/','Api\Crm\ServicesController@createService');
        Route::post('/edit','Api\Crm\ServicesController@editService');
        Route::post('/category','Api\Crm\ServicesController@createCategory');
        Route::post('/category/edit','Api\Crm\ServicesController@editCategory');
        Route::post('/category/delete','Api\Crm\ServicesController@deleteCategory');
        Route::post('/delete','Api\Crm\ServicesController@deleteService');
    });

    Route::group(['prefix' => 'employees'], function () {
        Route::get('/','Api\Crm\EmployeeController@index');
        Route::post('/','Api\Crm\EmployeeController@create');
        Route::post('/edit','Api\Crm\EmployeeController@edit');
        Route::post('/delete','Api\Crm\EmployeeController@delete');
        
    });

    Route::group(['prefix' => 'clients'], function () {
        Route::get('/','Api\Crm\ClientsController@index');
        Route::post('/','Api\Crm\ClientsController@create');
        Route::post('/edit','Api\Crm\ClientsController@edit');
        Route::post('/delete','Api\Crm\ClientsController@delete');
    });

    Route::group(['prefix' => 'goods'], function () {
        Route::get('/','Api\Crm\GoodsController@index');
        Route::post('/','Api\Crm\GoodsController@createGood');
        Route::post('/edit','Api\Crm\GoodsController@editGood');
        Route::post('/delete','Api\Crm\GoodsController@deleteGood');
        Route::post('/category','Api\Crm\GoodsController@createCategory');
        Route::post('/category/edit','Api\Crm\GoodsController@editCategory');
        Route::post('/category/delete','Api\Crm\GoodsController@deleteCategory');
    });

    Route::get('list/cars','Api\Crm\CommonController@cars');
    Route::get('list/services','Api\Crm\CommonController@services');
    Route::get('list/employees','Api\Crm\CommonController@employees');
    Route::get('list/clients','Api\Crm\CommonController@clients');
    
});