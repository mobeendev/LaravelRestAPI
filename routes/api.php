<?php

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
Route::prefix('auth')->group(function($router) {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
});

Route::group(['middleware' => ['jwt.auth']], function() {

    Route::prefix('auth')->group(function($router) {
        Route::get('user', 'AuthController@user');
    });


    Route::prefix('products')->group(function($router) {
        Route::get('/', 'ProductsController@index');

        Route::get('/{product}', 'ProductsController@show');

        Route::post('/', 'ProductsController@store');

        Route::put('/{product}', 'ProductsController@update');

        Route::delete('/{product}', 'ProductsController@delete');
    });

    Route::get('logout', 'AuthController@logout');
});
