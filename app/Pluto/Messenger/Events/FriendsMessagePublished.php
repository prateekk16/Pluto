<?php

namespace Pluto\Messenger\Events;


class FriendsMessagePublished{

	public $body;
	public $user_id;
	public $incognito;
	public $global;

	function __construct($user_id,$body,$incognito,$global){

		$this->body = $body;
		$this->user_id = $user_id;
		$this->incognito = $incognito;
		$this->global = $global;
	}
}