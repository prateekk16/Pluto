<?php

namespace Pluto\FriendRequests;
use Laracasts\Commander\CommandHandler;
use Pluto\FriendRequests\FriendRepository;
use Pluto\FriendRequests\FriendRequest;
use Laracasts\Commander\Events\DispatchableTrait;
use Pluto\Users\User;


class PublishFriendRespondCommandHandler implements CommandHandler{

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

		$sender = User::where('id','=',$command->friendId)->firstOrFail();
        $receiver = User::where('id','=',$command->userId)->firstOrFail();
        $responseType = $command->responseType;



        $check_request = FriendRequest::where('sender_id',$sender->id)
        							  ->where('receiver_id',$receiver->id)
        							  ->where('pending','1')->first();

        $check_pending = FriendRequest::where('sender_id',$receiver->id)
        							  ->where('receiver_id',$sender->id)
        							  ->where('pending','1')->first();

        if($responseType == '1') {

            if($check_request != null){
                $check_request->pending = '0';
                $check_request->save(); 
                return FriendRequest::getFriendRequests($command->userId)->count();          
            }else if($check_pending != null){
                $check_pending->pending = '0';
                $check_pending->save();   
                return FriendRequest::getFriendRequests($command->userId)->count();         
            }else{
                return "Error Occured";
            }

        }else if($responseType == '0'){
             if($check_request != null){                
                 $check_request->delete();
                 return FriendRequest::getFriendRequests($command->userId)->count();     
             }else if($check_pending != null){
                $check_pending->delete();                 
                return FriendRequest::getFriendRequests($command->userId)->count();         
            }else{
                return "Error Occured";
            }
        }    					  
  
        
		

	}

}


