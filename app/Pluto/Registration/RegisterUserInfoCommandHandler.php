<?php

namespace Pluto\Registration;
use Laracasts\Commander\CommandHandler;
use Pluto\Users\UserInfoRepository;
use Pluto\Users\UserInfo;
use Laracasts\Commander\Events\DispatchableTrait;

class RegisterUserInfoCommandHandler implements CommandHandler{

	use DispatchableTrait;

	protected $repository;

	function __construct(UserInfoRepository $repository){

		$this->repository = $repository;
	}


	/**
	 * [Handle the command]
	 * @param  [type] $command [description]
	 * @return [type]          [description]
	 */
	public function handle($command){

		
		$user = UserInfo::register(
				$command->firstname,
				$command->lastname,
				$command->gender,
				$command->user_id,
				$command->image_url
			);

		$this->repository->save($user);			

		return $user;
		
		

	}

}