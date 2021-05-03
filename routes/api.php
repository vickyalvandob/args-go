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


Route::post('login', 'Api\AuthController@login');
Route::post('register', 'Api\AuthController@register');
Route::get('general', 'Api\HomeController@general');

Route::middleware('api')->name('api.')->group(function () {

    Route::post('logout', 'Api\AuthController@logout');
    Route::post('refresh', 'Api\AuthController@refresh');

    Route::get('/profile', 'Api\HomeController@profile_index');
    Route::post('/profile', 'Api\HomeController@profile_update');
    Route::get('/energyBoost', 'Api\HomeController@energyBoost_index');
    Route::post('/energyBoost', 'Api\HomeController@energyBoost_store');
    Route::post('/password', 'Api\HomeController@password_update');

    Route::get('/transfer', 'Api\HomeController@transfer_index');
    Route::post('/transfer', 'Api\HomeController@transfer_store');
    Route::get('/collection', 'Api\HomeController@collection_index');

    Route::get('/coinCollect', 'Api\HomeController@coinCollect_index');
    Route::post('/coinCollect', 'Api\HomeController@coinCollect_store');
    Route::get('/coinClaim', 'Api\HomeController@coinClaim_index');
    Route::post('/coinClaim', 'Api\HomeController@coinClaim_store');

    Route::get('/rewardCollect', 'Api\HomeController@rewardCollect_index');
    Route::post('/rewardCollect', 'Api\HomeController@rewardCollect_store');
    Route::get('/rewardSell', 'Api\HomeController@rewardSell_index');
    Route::post('/rewardSell', 'Api\HomeController@rewardSell_store');
    Route::get('/rewardClaim', 'Api\HomeController@rewardClaim_index');
    Route::post('/rewardClaim', 'Api\HomeController@rewardClaim_store');
    Route::get('/rewardBuy', 'Api\HomeController@rewardBuy_index');
    Route::post('/rewardBuy', 'Api\HomeController@rewardBuy_store');

    Route::get('/puzzleCollect', 'Api\HomeController@puzzleCollect_index');
    Route::post('/puzzleCollect', 'Api\HomeController@puzzleCollect_store');
    Route::get('/puzzleClaim', 'Api\HomeController@puzzleClaim_index');
    Route::post('/puzzleClaim', 'Api\HomeController@puzzleClaim_store');
    Route::get('/puzzlePieceCollect', 'Api\HomeController@puzzlePieceCollect_index');
    Route::post('/puzzlePieceCollect', 'Api\HomeController@puzzlePieceCollect_store');
    Route::get('/puzzlePieceSell', 'Api\HomeController@puzzlePieceSell_index');
    Route::post('/puzzlePieceSell', 'Api\HomeController@puzzlePieceSell_store');
    Route::get('/puzzlePieceBuy', 'Api\HomeController@puzzlePieceBuy_index');
    Route::post('/puzzlePieceBuy', 'Api\HomeController@puzzlePieceBuy_store');

    Route::get('/weapon', 'Api\HomeController@weapon_index');
    Route::post('/weapon', 'Api\HomeController@weapon_store');
    Route::get('/weaponCollect', 'Api\HomeController@weaponCollect_index');
    Route::post('/weaponCollect', 'Api\HomeController@weaponCollect_store');

    Route::get('/topUp', 'Api\HomeController@topUp_index');
    Route::post('/topUp', 'Api\HomeController@topUp_store');
    Route::get('/payout', 'Api\HomeController@payout_index');
    Route::post('/payout', 'Api\HomeController@payout_store');




});

