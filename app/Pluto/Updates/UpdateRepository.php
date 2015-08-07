<?php

namespace Pluto\Updates;
use Pluto\Updates\Update;
use Pluto\Users\User;
use Pluto\FriendRequests\FriendRequest;
use Pluto\Statuses\Status;

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

	public function getStatuses($sender,$postId,$user){
		

		if(checkFriendship($sender,$user)){
			$status = Status::where('id',$postId)->first();
 			return $status->body;	
		}

		return 0;
 								

	}


}