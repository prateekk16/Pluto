<?php

use Pluto\Forms\RegistrationForm;
use Laracasts\Commander\CommanderTrait;
use Pluto\Registration\RegisterUserCommand;
use Pluto\Registration\RegisterUserInfoCommand;
use Pluto\Partials\SessionManager;

class RegistrationController extends BaseController {

	use CommanderTrait;

	/**
	 * @var RegistrationForm
	 */
	private $registrationForm;

	

	/**
	 * @param RegistrationForm $registrationForm
	 */
	function __construct(RegistrationForm $registrationForm, SessionManager $sessionManager)
	{
		$this->registrationForm = $registrationForm;
		$this->sessionManager = $sessionManager;
		$this->beforeFilter('guest', ['only' => ['create', 'store']]);
	
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
	     $user = $this->execute($command);

	     $url = public_path();		

	     $userinfo = Input::only('firstname','lastname','gender');
		 $userinfo = array_merge($userinfo, [ 'user_id'   => $user->id,
		 									  'image_url' => '../img/blank_med.jpg'
		 									]);	
	     $userinfo = $this->execute(RegisterUserInfoCommand::class, $userinfo);

	     
	     $user_id = Auth::login($user);
	     $this->sessionManager->setupSession(Auth::user());
		 return Redirect::home();
	}

}