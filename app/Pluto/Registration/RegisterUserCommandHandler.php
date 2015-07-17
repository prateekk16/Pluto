<?php

namespace Pluto\Registration;
use Laracasts\Commander\CommandHandler;

class RegisterUserCommandHandler implements CommandHandler{

	/**
	 * [Handle the command]
	 * @param  [type] $command [description]
	 * @return [type]          [description]
	 */
	public function handle($command){
		dd($command);
		
		// $user = User::register(
		// 		$command->username, $command->email, $command->password
		// 	);
		// $user = User::create($input);

		// $profile = new UserInfo;
		// $profile->user_id = $user->id;
		// $profile->firstname = Input::get('firstname');
		// $profile->lastname = Input::get('lastname');
		// $profile->save();
		

	}

}