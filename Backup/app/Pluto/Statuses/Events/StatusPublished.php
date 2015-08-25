<?php

namespace Pluto\Statuses\Events;


class StatusPublished{

	public $body;

	function __construct($body){

		$this->body = $body;
	}
}