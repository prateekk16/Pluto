<?php

namespace Pluto\Statuses;
use Laracasts\Commander\CommandHandler;
use Pluto\Statuses\StatusRepository;

use Laracasts\Commander\Events\DispatchableTrait;

class PublishStatusCommandHandler implements CommandHandler{

	use DispatchableTrait;

	protected $statusRepository;

	function __construct(StatusRepository $statusRepository){

		$this->statusRepository = $statusRepository;
	}


	/**
	 * [Handle the command]
	 * @param  [type] $command [description]
	 * @return [type]          [description]
	 */
	public function handle($command){

		 $status = Status::publish($command->body);	
		 

		 $status = $this->statusRepository->save($status, $command->userId);		

		 $this->dispatchEventsFor($status);

		 return $status;
		
		

	}

}