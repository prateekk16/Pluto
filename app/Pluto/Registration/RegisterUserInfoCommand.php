<?php

namespace Pluto\Registration;

class RegisterUserInfoCommand {

	public $firstname;
	public $lastname;
	public $user_id;

	function __construct($firstname,$lastname,$user_id){

		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->user_id = $user_id;
	}


}