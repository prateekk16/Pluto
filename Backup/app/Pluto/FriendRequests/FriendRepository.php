<?php

namespace Pluto\FriendRequests;
use Pluto\Users\User;
use Pluto\FriendRequests\FriendRequest;

class FriendRepository{

	/**
	 * [Persist a User]
	 * @param  User   $user [description]
	 * @return [type]       [description]
	 */
	public function save(FriendRequest $request){
		
		return $request->save();
	}


}