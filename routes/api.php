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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::POST('register', 'RegisterController@register');
Route::POST('login', 'RegisterController@authenticate');

Route::group(['middleware' => ['jwt.verify']], function() {

    Route::get('view', 'HomeController@getAuthenticatedUser');
	Route::POST('update', 'HomeController@update');
	Route::GET('country', 'HomeController@getcountry');
	Route::POST('state', 'HomeController@getstate');
	Route::POST('city', 'HomeController@getcity');
	Route::post('logout', 'HomeController@logout');

});
