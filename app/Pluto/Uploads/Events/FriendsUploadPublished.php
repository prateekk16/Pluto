<?php

namespace Pluto\Uploads\Events;


class FriendsUploadPublished{
	
	public $user_id;
	public $file;
	public $global;

	function __construct($user_id,$global,$file){
		
		$this->user_id = $user_id;
		$this->file = $file;
		$this->global = $global;
	}
}