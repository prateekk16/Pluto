<?php

namespace Pluto\FriendRequests;
use Laracasts\Commander\Events\EventGenerator;
use Pluto\FriendRequests\Events\FriendRequestPublished;



class FriendRequest extends \Eloquent {

	use EventGenerator;

	/**
	 * [$fillable fields for a  new status]
	 * @var array
	 */
	protected $fillable = ['sender_id','receiver_id','pending'];

	/**
	 * [$table description]
	 * @var string
	 */
	protected $table = 'friend_request_notifications';
	

	  

	public static function request($sender_id,$receiver_id,$pending){	   	  

       $request = new static(compact('sender_id','receiver_id','pending'));
       $request->raise(new FriendRequestPublished($sender_id,$receiver_id,$pending));      
       return $request;

 	}

}
