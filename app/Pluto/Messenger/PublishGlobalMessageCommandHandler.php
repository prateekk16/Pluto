<?php

namespace Pluto\Messenger;
use Laracasts\Commander\CommandHandler;
use Pluto\Messenger\MessageRepository;
use Laracasts\Commander\Events\DispatchableTrait;
use Pluto\Messenger\Models\Message;

class PublishGlobalMessageCommandHandler implements CommandHandler{

	use DispatchableTrait;

	protected $messageRepository;

	function __construct(MessageRepository $messageRepository){

		$this->messageRepository = $messageRepository;
	}


	/**
	 * [Handle the command]
	 * @param  [type] $command [description]
	 * @return [type]          [description]
	 */
	public function handle($command){

		 $message1 = Message::publish($command->user_id,$command->message,$command->global,$command->incognito);

		 $this->messageRepository->save($message1);		

		 $this->dispatchEventsFor($message1);

		 return $message1;
		
		
		

	}

}


