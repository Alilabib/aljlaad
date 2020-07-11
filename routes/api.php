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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::any('/', function () {
    dd('1');
});
Route::group(['namespace' => 'Api'], function () {
    Route::group(['namespace' => 'User','prefix'=>'user'], function() {
        Route::post('login'          ,'Auth\LoginController@login'    );
        Route::post('register'       ,'Auth\LoginController@register' );
        Route::post('active'         ,'Auth\LoginController@active'   );
        Route::post('forget/password','Auth\LoginController@forget'   );
        Route::post('reset/password' ,'Auth\LoginController@updatePassword');
        Route::post('send/code'      ,'Auth\LoginController@sendCode' );

        Route::group(['middleware' => 'auth.jwt'], function () {
            Route::get('logout', 'ApiController@logout');
            Route::get('categories','CategoryController@getAll');
        });
    });
    
    Route::group(['namespace' => 'Driver','prefix'=>'driver'], function() {
        Route::post('login', 'Auth\LoginController@login');
        Route::post('register', 'Auth\LoginController@register');
        Route::post('active', 'Auth\LoginController@register');
        Route::post('forget/password','Auth\LoginController@forget');
        Route::post('reset/password','Auth\LoginController@reset');
        Route::group(['middleware' => 'auth.jwt'], function () {
            Route::get('logout', 'ApiController@logout');
            Route::get('categories','CategoryController@getAll');
        });
    });
});


