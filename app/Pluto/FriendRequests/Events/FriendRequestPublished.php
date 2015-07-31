<?php

namespace Pluto\FriendRequests\Events;
use Pluto\FriendRequests\FriendRequest;

class FriendRequestPublished{

	public $sender_id;
	public $receiver_id;
	public $pending;
	

	function __construct($sender_id,$receiver_id,$pending){

		$this->sender_id = $sender_id;
		$this->receiver_id = $receiver_id;
		$this->pending = $pending;
		
	}
}