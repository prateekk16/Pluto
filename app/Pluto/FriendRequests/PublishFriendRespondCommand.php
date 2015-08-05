<?php

namespace Pluto\FriendRequests;

class PublishFriendRespondCommand {

	public $friendId;
	public $responseType;
	public $userId;
	

	function __construct($friendId, $responseType, $userId){

		$this->friendId   = $friendId;
		$this->responseType = $responseType;
		$this->userId = $userId;
		
	}


}


