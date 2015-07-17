<?php

namespace Pluto\Users;

class UserRepository{



	/**
	 * [Persist a User]
	 * @param  User   $user [description]
	 * @return [type]       [description]
	 */
	public function save(User $user){

		return $user->save();
	}


}