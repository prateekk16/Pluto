<?php

namespace Pluto\Uploads;

class PublishFriendsUploadCommand {

	public $file;
	public $user_id;
	public $global;
	
	

	function __construct($user_id, $global, $file){
			
		$this->user_id = $user_id;
		$this->global = $global;
		$this->file = $file;
		
	}


}


