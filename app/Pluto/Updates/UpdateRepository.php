<?php

namespace Pluto\Updates;
use Pluto\Updates\Update;


class UpdateRepository{


	/**
	 * Save a new status for user
	 * @param  Status $status [description]
	 * @param  [type] $userId [description]
	 * @return [type]         [description]
	 */
	public function save(Update $update){

		return $update->save();

		
	}


}