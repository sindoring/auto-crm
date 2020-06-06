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
Auth::routes();

Route::get('/', function () {
    if(Auth::user()!=null){
        if(Auth::user()->permission!='admin'){
            return redirect()->to('crm/bids');
        }
        return redirect()->to('crm/dashboard');
    }
    return view('auth.login');
})->name('landing');

Route::get('/crm', 'HomeController@index')->name('crm');
Route::get('/crm/{any}', 'HomeController@index')->where('any','.*');

