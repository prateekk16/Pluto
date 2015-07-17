<?php

namespace Pluto\Registration\Events;
use Pluto\Users\User;

class UserRegistered{

	public $user;

	function __construct(User $user){

		$this->user = $user;
	}
}