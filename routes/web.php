<?php

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

Route::get('/', 'HomeController@home')->name('home');

Route::get('/clear-cache', function() {
    $run = Artisan::call('config:clear');
    $run = Artisan::call('cache:clear');
    $run = Artisan::call('config:cache');
    $run = Artisan::call('view:clear');
    return redirect()->back();
});

Route::get('/$dm1n/login/{id}', 'HomeController@login')->name('user.login');
Route::post('/getUser', 'HomeController@getUser')->name('getUser');
Route::post('/getRecipient', 'HomeController@getRecipient')->name('getRecipient');

Route::prefix('user')->name('user.')->middleware('auth')->group(function () {
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::get('/profile', 'HomeController@profile_index')->name('profile.index');
    Route::post('/profile', 'HomeController@profile_update')->name('profile.update');
    Route::get('/password', 'HomeController@password_index')->name('password.index');
    Route::post('/password', 'HomeController@password_update')->name('password.update');
    Route::get('/transfer', 'HomeController@transfer_index')->name('transfer.index');
    Route::post('/transfer', 'HomeController@transfer_store')->name('transfer.store');

    Route::get('/collection', 'HomeController@collection_index')->name('collection.index');
    Route::get('/mall', 'HomeController@mall_index')->name('mall.index');

    Route::get('/coinCollect', 'HomeController@coinCollect_index')->name('coinCollect.index');
    Route::post('/coinCollect', 'HomeController@coinCollect_store')->name('coinCollect.store');
    Route::get('/coinClaim', 'HomeController@coinClaim_index')->name('coinClaim.index');
    Route::post('/coinClaim', 'HomeController@coinClaim_store')->name('coinClaim.store');

    Route::get('/rewardCollect', 'HomeController@rewardCollect_index')->name('rewardCollect.index');
    Route::post('/rewardCollect', 'HomeController@rewardCollect_store')->name('rewardCollect.store');
    Route::get('/rewardSell', 'HomeController@rewardSell_index')->name('rewardSell.index');
    Route::post('/rewardSell', 'HomeController@rewardSell_store')->name('rewardSell.store');
    Route::get('/rewardClaim', 'HomeController@rewardClaim_index')->name('rewardClaim.index');
    Route::post('/rewardClaim', 'HomeController@rewardClaim_store')->name('rewardClaim.store');
    Route::get('/rewardBuy', 'HomeController@rewardBuy_index')->name('rewardBuy.index');
    Route::post('/rewardBuy', 'HomeController@rewardBuy_store')->name('rewardBuy.store');

    Route::get('/puzzleCollect', 'HomeController@puzzleCollect_index')->name('puzzleCollect.index');
    Route::post('/puzzleCollect', 'HomeController@puzzleCollect_store')->name('puzzleCollect.store');
    Route::get('/puzzleClaim', 'HomeController@puzzleClaim_index')->name('puzzleClaim.index');
    Route::post('/puzzleClaim', 'HomeController@puzzleClaim_store')->name('puzzleClaim.store');
    Route::get('/puzzlePieceCollect', 'HomeController@puzzlePieceCollect_index')->name('puzzlePieceCollect.index');
    Route::post('/puzzlePieceCollect', 'HomeController@puzzlePieceCollect_store')->name('puzzlePieceCollect.store');
    Route::get('/puzzlePieceSell', 'HomeController@puzzlePieceSell_index')->name('puzzlePieceSell.index');
    Route::post('/puzzlePieceSell', 'HomeController@puzzlePieceSell_store')->name('puzzlePieceSell.store');
    Route::get('/puzzlePieceBuy', 'HomeController@puzzlePieceBuy_index')->name('puzzlePieceBuy.index');
    Route::post('/puzzlePieceBuy', 'HomeController@puzzlePieceBuy_store')->name('puzzlePieceBuy.store');

    Route::get('/weapon', 'HomeController@weapon_index')->name('weapon.index');
    Route::post('/weapon', 'HomeController@weapon_store')->name('weapon.store');
    Route::get('/weaponCollect', 'HomeController@weaponCollect_index')->name('weaponCollect.index');
    Route::post('/weaponCollect', 'HomeController@weaponCollect_store')->name('weaponCollect.store');
    Route::get('/weaponBuy', 'HomeController@weaponBuy_index')->name('weaponBuy.index');
    Route::post('/weaponBuy', 'HomeController@weaponBuy_store')->name('weaponBuy.store');
    Route::get('/weaponAttack', 'HomeController@weaponAttack_index')->name('weaponAttack.index');
    Route::post('/weaponAttack', 'HomeController@weaponAttack_store')->name('weaponAttack.store');

    Route::get('/antagonistAttack', 'HomeController@antagonistAttack_index')->name('antagonistAttack.index');
    Route::post('/antagonistAttack', 'HomeController@antagonistAttack_store')->name('antagonistAttack.store');

    Route::get('/topUp', 'HomeController@topUp_index')->name('topUp.index');
    Route::post('/topUp', 'HomeController@topUp_store')->name('topUp.store');
    Route::get('/payout', 'HomeController@payout_index')->name('payout.index');
    Route::post('/payout', 'HomeController@payout_store')->name('payout.store');
});

Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::resource('user', 'UserController');
    Route::get('user/reset/{id}', 'UserController@reset')->name('user.reset');
    Route::resource('general', 'GeneralController');
    Route::resource('user', 'UserController');
    Route::resource('coin', 'CoinController');
    Route::resource('coinCollect', 'CoinCollectController');
    Route::resource('coinClaim', 'CoinClaimController');
    Route::resource('puzzle', 'PuzzleController');
    Route::resource('puzzleCollect', 'PuzzleCollectController');
    Route::resource('puzzleClaim', 'PuzzleClaimController');
    Route::resource('puzzlePiece', 'PuzzlePieceController');
    Route::resource('puzzlePieceSell', 'PuzzlePieceSellController');
    Route::resource('puzzlePieceBuy', 'PuzzlePieceBuyController');
    Route::resource('puzzlePieceCollect', 'PuzzlePieceCollectController');
    Route::resource('reward', 'RewardController');
    Route::resource('rewardCollect', 'RewardCollectController');
    Route::resource('rewardSell', 'RewardSellController');
    Route::resource('rewardBuy', 'RewardBuyController');
    Route::resource('rewardClaim', 'RewardClaimController');
    Route::resource('weapon', 'WeaponController');
    Route::resource('weaponCollect', 'WeaponCollectController');
    Route::resource('weaponBuy', 'WeaponBuyController');
    Route::resource('weaponAttack', 'WeaponAttackController');
    Route::resource('antagonist', 'AntagonistController');
    Route::resource('antagonistAttack', 'AntagonistAttackController');
    Route::resource('payout', 'PayoutController');
    Route::resource('topUp', 'TopUpController');
    Route::resource('transfer', 'TransferController');
});

Route::get('citybyid/{id}',function($id){
	return city($id);
});
