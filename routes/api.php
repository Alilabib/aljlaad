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

    Route::post('contactus','User\HomeController@contactus');

    Route::group(['namespace' => 'User','prefix'=>'user'], function() {
        Route::get('cities'          ,'HomeController@cities');
        Route::post('areas'          ,'HomeController@areas');
        Route::post('login'          ,'Auth\LoginController@login'    );
        Route::post('register'       ,'Auth\LoginController@register' );
        Route::post('active'         ,'Auth\LoginController@active'   );
        Route::post('forget/password','Auth\LoginController@forget'   );
        Route::post('reset/password' ,'Auth\LoginController@updatePassword');
        Route::post('send/code'      ,'Auth\LoginController@sendCode' );
        Route::get('home'            ,'HomeController@index');
        Route::get('categories'      ,'CategoryController@getAll');
        Route::get('questions'       ,'CategoryController@questions');
        Route::get('companies'       ,'HomeController@companies');
        Route::post('products'       ,'HomeController@products');
        Route::post('product'        ,'HomeController@product');
        Route::get('contact'         ,'HomeController@contact');
        Route::get('about'           ,'HomeController@about');
        Route::get('policy'          ,'HomeController@policy');
        Route::post('contactus'      ,'HomeController@contactUs');
        Route::get('offers'         ,'OfferController@getAll');
        Route::get('get/offer'      ,'OfferController@getOffer');
        Route::group(['middleware' => 'auth.jwt'], function () {
            Route::post('logout'            , 'ApiController@logout');
            Route::post('update/password'   ,'ProfileController@updatePassword');
            Route::post('add/to/cart'       ,'CartController@add');
            Route::get('cart/products/count','CartController@cartproudctsCount');
            Route::get('get/cart'           ,'CartController@viewCart');
            Route::post('delete/form/cart'  ,'CartController@delete');
            Route::post('add/address'       ,'OrderController@addAddress');
            Route::get('continue/shopping'  ,'OrderController@continueShopping');
            Route::post('create/order'      ,'OrderController@newOrder');
            Route::get('orders'             ,'OrderController@allorders');
            Route::get('orders/pending'     ,'OrderController@pendingOrders');
            Route::post('order/details'     ,'OrderController@order');
            Route::post('order/cancel'      ,'OrderController@cacncelOrder');
            Route::get('orders/delivered'   ,'OrderController@deliveredOrders');
            Route::get('get/addresses'      ,'OrderController@getAddresses');
            Route::post('get/address'       ,'OrderController@getAddress');
            Route::post('update/address'    ,'OrderController@updateAddress');
            Route::post('delete/address'    ,'OrderController@deleteAddress');
            Route::post('update/profile'    ,'ProfileController@updateProfile');
            Route::post('create/offer/order','OfferController@createOffer');
            Route::post('toggle/fav','OfferController@wishlistToggle');
            Route::get('fav','OfferController@favCompanies');
            Route::get('goals','OfferController@Goals');
            Route::get('goal','OfferController@Goal');
            Route::post('order/rate','ProfileController@Rate');
            Route::get('apply/coupoun','OrderController@applyCoupon');
        });
    });

    Route::group(['namespace' => 'provider','prefix'=>'driver'], function() {
        Route::post('login'          , 'Auth\LoginController@login');
        Route::post('register'       , 'Auth\LoginController@register');
        Route::post('active'         ,'Auth\LoginController@active'   );
        Route::post('forget/password','Auth\LoginController@forget'   );
        Route::post('reset/password' ,'Auth\LoginController@updatePassword');
        Route::post('send/code'      ,'Auth\LoginController@sendCode' );
        Route::group(['middleware' => 'auth.jwt'], function () {
            Route::post('logout'         , 'ApiController@logout');
            Route::post('update/password','ProfileController@updatePassword');
            Route::get('categories'      ,'CategoryController@getAll');
            Route::get('pending/orders'  ,'OrderController@pending');
            Route::post('order/details'  ,'OrderController@details');
            Route::get('orders'             ,'OrderController@allorders');
            Route::post('accept/order'   ,'OrderController@acceptOrder');
            Route::post('inway/order','OrderController@inwayOrder');

            Route::post('deliver/order'  ,'OrderController@DeliverOrder');
            Route::get('compelete/orders','OrderController@compeleted');
            Route::post('update/profile' ,'ProfileController@updateProfile');
            Route::post('order/problem'  ,'OrderController@problem');
        });
    });
});


