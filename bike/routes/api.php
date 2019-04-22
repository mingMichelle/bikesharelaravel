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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function (){
    Route::group(['prefix' => 'user', 'as' => 'user'], function() {
        Route::get('/info', 'Api\UserController@getMyInfo');
        Route::post('/deposit', 'Api\UserController@payDeposit');
        Route::delete('/deposit', 'Api\UserController@backDeposit');
        Route::post('pay_money', 'Api\UserController@payMoney');
        Route::get('current_rider', 'Api\UserController@getCurrentRider');
        Route::get('riders', 'Api\UserController@getMyRiders');
    });

    Route::post('unlock', 'Api\BikeController@unLockBike');
});

Route::post('lock', 'Api\BikeController@lockBike');
Route::get('bikes', 'Api\BikeController@getNearBikes');
Route::post('generate_bike', 'Api\BikeController@generateBikeByGeo');