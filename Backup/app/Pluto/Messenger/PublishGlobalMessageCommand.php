<?php

namespace Pluto\Messenger;

class PublishGlobalMessageCommand {

	public $message;
	public $user_id;
	public $global;
	

	function __construct($message, $user_id, $global){

		$this->message   = $message;
		$this->user_id = $user_id;
		$this->global = $global;
		
	}


}


