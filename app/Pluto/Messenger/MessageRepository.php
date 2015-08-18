<?php

namespace Pluto\Messenger;

use Pluto\Users\User;
use Pluto\Messenger\Models\Message;

class MessageRepository{

	/**
	 * Get all Status
	 * @param  User   $user [description]
	 * @return [type]       [description]
	 */
	public function getAllMessagesForUser(User $user){
		  return $user->messages()->with('user')->latest()->get();
		//
		// return Status::where('user_id',$user->id)
		// 			   ->orderBy('created_at', 'desc')->get();
	}


	
	public function save(Message $message){

		return $message->save();

		
	}


}