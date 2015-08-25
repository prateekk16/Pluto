<?php

namespace Pluto\FriendRequests;
use Laracasts\Commander\CommandHandler;
use Pluto\FriendRequests\FriendRepository;
use Pluto\FriendRequests\FriendRequest;
use Laracasts\Commander\Events\DispatchableTrait;
use Pluto\Users\User;


class PublishFriendRequestCommandHandler implements CommandHandler{

	use DispatchableTrait;
    protected $friendRepository;
	

	function __construct(FriendRepository $friendRepository){

		$this->friendRepository = $friendRepository;
	}


	/**
	 * [Handle the command]
	 * @param  [type] $command [description]
	 * @return [type]          [description]
	 */
	public function handle($command){

		$sender = User::where('email','=',$command->senderEmail)->firstOrFail();
        $receiver = User::where('email','=',$command->email)->firstOrFail();



        $check_request = FriendRequest::where('sender_id',$sender->id)
        							  ->where('receiver_id',$receiver->id)
        							  ->where('pending','1')->first();

        $check_pending = FriendRequest::where('sender_id',$receiver->id)
        							  ->where('receiver_id',$sender->id)
        							  ->where('pending','1')->first();

            					  

        if( $check_request == null ){

        	 if( $check_pending == null ){

        	 	$request = FriendRequest::request($sender->id,$receiver->id,'1');
	      	    $this->friendRepository->save($request);	
	            $this->dispatchEventsFor($request);	
	                
	            return 1;	
        	 	
       		 }else{
       		 	return "A Friend Request is already Pending from this user.";
       		 }	

        }else{
        	return "You have already sent a Friend Request to this user.";
        }



       
		

	}

}


