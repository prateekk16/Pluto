<?php

namespace Pluto\Registration;

class RegisterUserInfoCommand {

	public $firstname;
	public $lastname;
	public $user_id;
	public $gender;

	function __construct($firstname,$lastname,$gender,$user_id){

		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->user_id = $user_id;
		$this->gender = $gender;
	}


}