<?php

namespace Pluto\Messenger\Events;


class GlobalMessagePublished{

	public $body;
	public $user_id;

	function __construct($user_id,$body){

		$this->body = $body;
		$this->user_id = $user_id;
	}
}