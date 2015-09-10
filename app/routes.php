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






Route::when('*', 'csrf', ['post', 'put', 'patch']);


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
Route::post('sendFriendRequest', ['as' => 'sendFriendRequest', 'uses' =>'FriendRequestController@create']);

#Add Favourite
Route::post('/api/addFavourite', ['as' => 'addFaourite', 'uses' =>'FriendRequestController@addFavourite']);

#Event for Friend Request Reponse
Route::post('respond-to-friend-request', ['as' => 'respond_to_friend_request', 'uses' =>'FriendRequestController@store']);

#Event for Status Update
Route::post('news-update-check-friendship', ['as' => 'news-update-check-friendship', 'uses' =>'UpdatesController@show']); 


#Search APi

Route::get('api/lookUp/{type}', 'ApiSearchController@lookUp');


Route::group(['prefix' => 'messages', 'before'=>'auth'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::post('/post-global', ['as' => 'messages.storeGlobal', 'uses' => 'MessagesController@storeGlobal']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
    Route::post('/decrypt-message', ['as' => 'decrypt-message', 'uses' => 'HelperController@decryptMessage']);
});




