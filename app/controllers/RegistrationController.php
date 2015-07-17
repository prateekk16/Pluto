<?php

use Pluto\Forms\RegistrationForm;

class RegistrationController extends BaseController {

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

		$user = User::create($input);

		$profile = new UserInfo;
		$profile->user_id = $user->id;
		$profile->firstname = Input::get('firstname');
		$profile->lastname = Input::get('lastname');
		$profile->save();

		Auth::login($user);

		return Redirect::home();
	}

}