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
        Route::get('cities'          ,'HomeController@cities');
        Route::post('areas'           ,'HomeController@areas');
        Route::post('login'          ,'Auth\LoginController@login'    );
        Route::post('register'       ,'Auth\LoginController@register' );
        Route::post('active'         ,'Auth\LoginController@active'   );
        Route::post('forget/password','Auth\LoginController@forget'   );
        Route::post('reset/password' ,'Auth\LoginController@updatePassword');
        Route::post('send/code'      ,'Auth\LoginController@sendCode' );
        Route::get('home','HomeController@index');
        Route::get('companies','HomeController@companies');
        Route::post('products','HomeController@products');
        Route::post('product','HomeController@product');
        Route::get('contact','HomeController@contact');
        Route::get('about','HomeController@about');
        Route::get('policy','HomeController@policy');
        
        Route::group(['middleware' => 'auth.jwt'], function () {
            Route::post('logout', 'ApiController@logout');
            Route::get('categories','CategoryController@getAll');
            Route::post('add/to/cart','CartController@add');
            Route::get('cart/products/count','CartController@cartproudctsCount');
            Route::get('get/cart','CartController@viewCart');
            Route::post('delete/form/cart','CartController@delete');
            Route::post('add/address'     ,'OrderController@addAddress');
            Route::get('continue/shopping','OrderController@continueShopping');
            Route::post('create/order','OrderController@newOrder');
            Route::get('orders/pending','OrderController@pendingOrders');
            Route::post('order/details','OrderController@order');
            Route::post('order/cancel','OrderController@cacncelOrder');
            Route::get('orders/delivered','OrderController@deliveredOrders');
            Route::get('get/addresses','OrderController@getAddresses');
            Route::post('update/address','OrderController@updateAddress');
            Route::post('delete/address','OrderController@deleteAddress');
            Route::post('update/profile','ProfileController@updateProfile');

        });
    });
    
    Route::group(['namespace' => 'provider','prefix'=>'driver'], function() {
        Route::post('login', 'ProfileController@login');
        Route::post('register', 'Auth\LoginController@register');
        Route::post('active'         ,'Auth\LoginController@active'   );
        Route::post('forget/password','Auth\LoginController@forget'   );
        Route::post('reset/password' ,'Auth\LoginController@updatePassword');
        Route::post('send/code'      ,'Auth\LoginController@sendCode' );
        Route::group(['middleware' => 'auth.jwt'], function () {
            Route::post('logout', 'ApiController@logout');
            Route::get('categories','CategoryController@getAll');
            Route::get('pending/orders','OrderController@pending');
            Route::post('order/details','OrderController@details');
            Route::post('accept/order','OrderController@acceptOrder');
            Route::post('deliver/order','OrderController@DeliverOrder');
            Route::get('compelete/orders','OrderController@compeleted');
            Route::post('update/profile','ProfileController@updateProfile');

        });
    });
});


