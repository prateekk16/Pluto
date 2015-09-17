<?php

namespace Pluto\Messenger;

class PublishGlobalMessageCommand {

	public $message;
	public $user_id;
	public $global;
	public $incognito;
	

	function __construct($message, $user_id, $global, $incognito){

		$this->message   = $message;
		$this->user_id = $user_id;
		$this->global = $global;
		$this->incognito = $incognito;
		
	}


}


