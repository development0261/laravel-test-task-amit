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

Route::get('/home', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('home');
});
Route::view('register','register');
Route::view('login','login');
Route::group(['middleware' => ['web']], function () {
	Route::get('home','HomeController@index');
    Route::get('edit','HomeController@edit');
});
