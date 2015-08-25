<?php

namespace Pluto\Updates;

class PublishUpdateCommand {

	public $postId;
	public $userId;
	public $type;
	

	function __construct($postId, $userId, $type){

		$this->postId   = $postId;
		$this->userId = $userId;
		$this->type = $type;
		
	}


}


