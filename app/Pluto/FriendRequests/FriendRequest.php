<?php

namespace Pluto\FriendRequests;
use Laracasts\Commander\Events\EventGenerator;
use Pluto\FriendRequests\Events\FriendRequestPublished;
use Pluto\Users\User;


class FriendRequest extends \Eloquent {

	use EventGenerator;

	/**
	 * [$fillable fields for a  new status]
	 * @var array
	 */
	protected $fillable = ['sender_id','receiver_id','pending'];

	/**
	 * [$table description]
	 * @var string
	 */
	protected $table = 'friend_request_notifications';
	

	  

	public static function request($sender_id,$receiver_id,$pending){	   	  

       $request = new static(compact('sender_id','receiver_id','pending'));
       $request->raise(new FriendRequestPublished($sender_id,$receiver_id,$pending));      
       return $request;

 	}

 	public static function getFriendRequests($id){
 		return FriendRequest::where('receiver_id',$id)
 								 ->where('pending','1')
 								 ->orderBy('created_at','desc')->get();
 	}

 	public static function MyFriends($id){
 		$array = array();

 		$loop1 = friendRequest::where('receiver_id',$id) 							
 							  ->where('pending','0')->get();
 	    if($loop1 != null){
 	    	foreach($loop1 as $user){
 	    		$friend = User::where('id',$user->sender_id)->first();
 	    		$array[] = $friend;
 	    	}
 	    }

 	    $loop2 = friendRequest::where('sender_id',$id) 							
 							  ->where('pending','0')->get();

 	      if($loop2 != null){
 	    	foreach($loop2 as $user){
 	    		$friend = User::where('id',$user->receiver_id)->first();
 	    		$array[] = $friend;
 	    	}
 	    }

 	    return $array;
 	}

}
