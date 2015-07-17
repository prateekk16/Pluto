<?php

use Pluto\Forms\RegistrationForm;
use Laracasts\Commander\CommanderTrait;
use Pluto\Registration\RegisterUserCommand;

class RegistrationController extends BaseController {

	use CommanderTrait;

	/**
	 * @var RegistrationForm
	 */
	private $registrationForm;

	

	/**
	 * @param RegistrationForm $registrationForm
	 */
	function __construct(RegistrationForm $registrationForm)
	{
		$this->registrationForm = $registrationForm;
	
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('registration.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		 $input = Input::only('username', 'email', 'password', 'password_confirmation', 'firstname','lastname');
		 $this->registrationForm->validate($input);

		 extract(Input::only('username', 'email', 'password', 'password_confirmation', 'firstname','lastname'));

		 $command = new RegisterUserCommand($email,$password,$username);
	     $this->execute($command);		



		 Auth::login($user);

		 return Redirect::home();
	}

}