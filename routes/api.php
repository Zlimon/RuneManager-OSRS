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

Route::prefix('/user')->group(function() {
	Route::post('/register', 'Api\UserController@register')->name('user-register');
	Route::post('/login', 'Api\UserController@login')->name('user-login');
});

Route::middleware('auth:api')->group(function() {
	Route::get('/user', 'Api\UserController@user')->name('user-show');
	Route::post('/authenticate', 'Api\AccountController@store')->name('authenticate'); // Authenticate user

	Route::prefix('/account')->group(function() {
		Route::put('/{accountUsername}/loot/{collection}', 'Api\AccountLootController@update')->name('account-loot-update'); // Put loot data - updates collection model
		Route::post('/{accountUsername}/collection/{collection}', 'Api\AccountCollectionController@update')->name('account-collection-update'); // Post collection data - replaces collection model
		Route::post('/{accountUsername}/skill/{skill}', 'Api\AccountSkillController@update')->name('account-skill-update');
	});
});

Route::prefix('/account')->group(function() {
	Route::get('/{account}', 'Api\AccountController@show')->name('account-show');
	Route::get('/{account}/skill', 'Api\AccountController@skill')->name('account-show-skill');
	Route::get('/{account}/boss', 'Api\AccountController@boss')->name('account-show-boss');
	Route::get('/{accountUsername}/collection/{collectionName}', 'Api\AccountCollectionController@show')->name('account-collection-show');
});

Route::prefix('/hiscore')->group(function() {
	Route::get('/skill/{skill}', 'Api\HiscoreController@skill')->name('hiscore-skill-show');
	Route::get('/boss/{skill}', 'Api\HiscoreController@boss')->name('hiscore-boss-show');
});

Route::prefix('/collection')->group(function() {
	Route::get('/{collectionType}', 'CollectionController@list');
});

Route::prefix('/notification')->group(function() {
	Route::get('/all', 'Api\NotificationController@index')->name('notification-show-all');
	Route::get('/account/{accountUsername}', 'Api\NotificationController@show')->name('notification-account-show');
});