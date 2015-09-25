<?php

namespace Pluto\Uploads;
use Laracasts\Commander\CommandHandler;
use Pluto\Uploads\UploadRepository;
use Laracasts\Commander\Events\DispatchableTrait;
use Pluto\Uploads\Models\Upload;

class PublishFriendsUploadCommandHandler implements CommandHandler{

	use DispatchableTrait;

	protected $uploadRepository;

	function __construct(UploadRepository $uploadRepository){

		$this->uploadRepository = $uploadRepository;
	}


	/**
	 * [Handle the command]
	 * @param  [type] $command [description]
	 * @return [type]          [description]
	 */
	public function handle($command){

		 $upload1 = Upload::publish($command->user_id,$command->global,$command->file);

		 $this->uploadRepository->save($upload1);		

		 $this->dispatchEventsFor($upload1);

		 return $upload1;
		
		
		

	}

}


