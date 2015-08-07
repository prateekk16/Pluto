<?php

namespace Pluto\Updates;
use Laracasts\Commander\CommandHandler;
use Pluto\Updates\UpdateRepository;
use Pluto\Updates\Update;
use Laracasts\Commander\Events\DispatchableTrait;

class PublishUpdateCommandHandler implements CommandHandler{

	use DispatchableTrait;

	protected $updateRepository;

	function __construct(UpdateRepository $updateRepository){

		$this->updateRepository = $updateRepository;
	}


	/**
	 * [Handle the command]
	 * @param  [type] $command [description]
	 * @return [type]          [description]
	 */
	public function handle($command){

		 $update = Update::publish($command->userId, $command->type, $command->postId);	
		 

		 $this->updateRepository->save($update);		

		 $this->dispatchEventsFor($update);

		 return $update;
		
		

	}

}


