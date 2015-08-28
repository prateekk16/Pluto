<?php

namespace Pluto\Registration;

class RegisterUserInfoCommand {

	public $firstname;
	public $lastname;
	public $user_id;
	public $gender;
	public $image_url;

	function __construct($firstname,$lastname,$gender,$user_id,$image_url){

		$this->firstname = $firstname;
		$this->lastname = $lastname;
		$this->user_id = $user_id;
		$this->gender = $gender;
		$this->image_url = $image_url;
	}


}