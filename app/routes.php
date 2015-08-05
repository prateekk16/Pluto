<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/











# Home
Route::get('/', ['as' => 'home', 'uses' => 'PagesController@index']);
# Registration
Route::get('/register', 'RegistrationController@create')->before('guest');
Route::post('/register', ['as' => 'registration.store', 'uses' => 'RegistrationController@store']);
# Authentication
Route::get('login', ['as' => 'login_path', 'uses' => 'SessionsController@create']);
Route::post('login', ['as' => 'login_path', 'uses' => 'SessionsController@store']);

Route::get('logout', ['as' => 'logout', 'uses' => 'SessionsController@destroy']);
Route::resource('sessions', 'SessionsController', ['only' => ['create', 'store', 'destroy']]);
# Profile
Route::resource('profile', 'ProfilesController', ['only' => ['show', 'edit', 'update']]);
Route::get('/{username}', ['as' => 'profile', 'uses' => 'ProfilesController@show']);
# Statuses
Route::post('status', ['as' => 'statuses_path', 'uses' =>'StatusController@store']);
Route::get('/status/user', ['as' => 'statuses_path_get', 'uses' =>'StatusController@index']);
#Profile Picture
Route::post('profilePicture', ['as' => 'profile_picture', 'uses' =>'ProfilePictureController@store']);
Route::post('AddFriendsEmail', ['as' => 'sendFriendEmailRequest', 'uses' =>'FriendRequestController@create']);

Route::post('respond-to-friend-request', ['as' => 'respond_to_friend_request', 'uses' =>'FriendRequestController@store']);




