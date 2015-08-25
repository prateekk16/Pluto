<?php

class Favourites extends Eloquent {

	protected $guarded = array();

	protected $table = 'favourite_friends';

	public static $rules = array();

	public function user()
	{
		 return $this->belongsToMany('Pluto\Users\User', 'favourite_user', 'favourite_id', 'user_id');
	}
}
