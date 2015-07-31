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

        $request = FriendRequest::request($sender->id,$receiver->id,'1');
        $this->friendRepository->save($request);	
        $this->dispatchEventsFor($request);
        
        return $request;
		

	}

}


