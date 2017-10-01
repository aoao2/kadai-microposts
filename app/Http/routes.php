<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');
Route::get('signup', 'Auth\AuthController@getRegister')->name('signup.get');
Route::post('signup', 'Auth\AuthController@postRegister')->name('signup.post');
Route::get('login', 'Auth\AuthController@getLogin')->name('login.get');
Route::post('login', 'Auth\AuthController@postLogin')->name('login.post');
Route::get('logout', 'Auth\AuthController@getLogout')->name('logout.get');
Route::group(['middleware' => 'auth'], function() {
    Route::resource('users', 'UserController', ['only' => ['index', 'show']]);
    Route::resource('microposts', 'MicropostController', ['only' => ['store', 'destroy']]);
    Route::group(['prefix' => 'users/{id}'], function() {
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
        Route::get('following', 'UserController@following')->name('user.following');
        Route::get('follower', 'UserController@follower')->name('user.follower');
        Route::get('liking', 'UserController@liking')->name('user.liking');
    });
    Route::group(['prefix' => 'micropost/{id}'], function() {
        Route::post('like', 'favoriteController@store')->name('micropost.like');
        Route::delete('unlike', 'favoriteController@destroy')->name('micropost.unlike');
    });
    
});
