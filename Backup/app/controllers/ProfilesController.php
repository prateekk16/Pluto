<?php

use Pluto\Forms\ProfileForm;

class ProfilesController extends BaseController {

	/**
	 * @var ProfileForm
	 */
	protected $profileForm;

	/**
	 * @param ProfileForm $profileForm
	 */
	function __construct(ProfileForm $profileForm)
	{
		$this->profileForm = $profileForm;

		$this->beforeFilter('currentUser', ['only' => ['edit', 'update']]);
	}

	/**
	 * /username
	 *
	 * @param $username
	 * @return Response
	 */
	public function show($username)
	{
		$user = $this->getUserByUsername($username);

		return View::make('profiles.show')->withUser($user);
	}

	/**
	 * /profiles/username/edit
	 *
	 * @param $username
	 * @return mixed
	 */
	public function edit($username)
	{
		$user = $this->getUserByUsername($username);

		return View::make('profiles.edit')->withUser($user);
	}

	/**
	 * Update a user's profile
	 *
	 * @param $username
	 * @return mixed
	 * @throws Laracasts\Validation\FormValidationException
	 */
	public function update($username)
	{
		$user = $this->getUserByUsername($username);
		$input = Input::only('firstname', 'lastname');

		$this->profileForm->validate($input);

		$user->info->fill($input)->save();

		return Redirect::route('profile.edit', $user->username);
	}

	/**
	 * Fetch user
	 * (You can extract this to repository method)
	 *
	 * @param $username
	 * @return mixed
	 */
	public function getUserByUsername($username)
	{
		return User::with('info')->whereUsername($username)->firstOrFail();
	}

}