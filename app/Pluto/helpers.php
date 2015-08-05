<?php
use Pluto\Users\User;
use Pluto\FriendRequests\FriendRequest;

function errors_for($attribute, $errors)
{
	return $errors->first($attribute, '<span class="error">:message</span>');
}
function link_to_profile($text = 'Profile')
{
    return link_to_route('profile', $text, Auth::user()->username);
}

function getLatestStatus(){
	return Auth::user()->statuses()->orderBy('created_at','desc')->first();
}

function getFriendRequests(){
	return FriendRequest::getFriendRequests(Auth::user()->id);
}

function getUserObject($id){
	return User::where('id',$id)->firstOrFail();
}

function getMyFriends(){
	 return FriendRequest::MyFriends(Auth::user()->id);
}



