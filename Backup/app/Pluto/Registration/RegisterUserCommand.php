<?php

namespace Pluto\Registration;

class RegisterUserCommand {

	public $username;
	public $email;
	public $password;

	function __construct($email,$password,$username){

		$this->email = $email;
		$this->username = $username;
		$this->password = $password;
	}


}