<?php

namespace Pluto\Updates\Events;


class UpdatePublished{

	public $user_id;
	public $type;
	public $post_id;

	function __construct($user_id, $type, $post_id){

		$this->user_id   = $user_id;
		$this->type = $type;
		$this->post_id = $post_id;
		
	}
}