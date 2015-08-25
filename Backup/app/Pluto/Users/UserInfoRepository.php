<?php

namespace Pluto\Users;

class UserInfoRepository{



	/**
	 * [Persist a User]
	 * @param  User   $user [description]
	 * @return [type]       [description]
	 */
	public function save(UserInfo $user){

		return $user->save();
	}


}