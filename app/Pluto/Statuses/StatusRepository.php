<?php

namespace Pluto\Statuses;

use Pluto\Users\User;

class StatusRepository{


	/**
	 * Save a new status for user
	 * @param  Status $status [description]
	 * @param  [type] $userId [description]
	 * @return [type]         [description]
	 */
	public function save(Status $status, User $userId){

		return User::findOrFail($userId)->statuses()->save($status);

		
	}


}