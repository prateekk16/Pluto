<?php

namespace Pluto\Statuses;

use Pluto\Users\User;

class StatusRepository{

	/**
	 * Get all Status
	 * @param  User   $user [description]
	 * @return [type]       [description]
	 */
	public function getAllForUser(User $user){
		  return $user->statuses()->with('user')->latest()->get();
		//
		// return Status::where('user_id',$user->id)
		// 			   ->orderBy('created_at', 'desc')->get();
	}


	/**
	 * Save a new status for user
	 * @param  Status $status [description]
	 * @param  [type] $userId [description]
	 * @return [type]         [description]
	 */
	public function save(Status $status, $userId){

		return User::findOrFail($userId)->statuses()->save($status);

		
	}


}