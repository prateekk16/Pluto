<?php

namespace Pluto\FriendRequests;

class PublishFriendRequestCommand {

	public $email;
	public $senderEmail;
	

	function __construct($email, $senderEmail){

		$this->email   = $email;
		$this->senderEmail = $senderEmail;
		
	}


}


