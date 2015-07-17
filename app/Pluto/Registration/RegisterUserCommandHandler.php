<?php

namespace Pluto\Registration;
use Laracasts\Commander\CommandHandler;
use Pluto\Users\UserRepository;
use Pluto\Users\User;
use Laracasts\Commander\Events\DispatchableTrait;

class RegisterUserCommandHandler implements CommandHandler{

	use DispatchableTrait;

	protected $repository;

	function __construct(UserRepository $repository){

		$this->repository = $repository;
	}


	/**
	 * [Handle the command]
	 * @param  [type] $command [description]
	 * @return [type]          [description]
	 */
	public function handle($command){

		
		$user = User::register(
				$command->username, $command->email, $command->password
			);

		$this->repository->save($user);		

		$this->dispatchEventsFor($user);

		return $user;
		// $user = User::create($input);

		// $profile = new UserInfo;
		// $profile->user_id = $user->id;
		// $profile->firstname = Input::get('firstname');
		// $profile->lastname = Input::get('lastname');
		// $profile->save();
		

	}

}