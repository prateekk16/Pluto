<?php

namespace Pluto\FriendRequests\Events;
use Pluto\FriendRequests\FriendRequest;

class FriendRequestPublished{

	public $sender_id;
	public $receiver_id;
	public $pending;
	public $request_id;
	

	function __construct($sender_id,$receiver_id,$pending,$request_id){

		$this->sender_id = $sender_id;
		$this->receiver_id = $receiver_id;
		$this->pending = $pending;
		$this->request_id = $request_id;
		
	}
}