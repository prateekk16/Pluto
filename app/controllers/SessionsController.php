<?php

use Pluto\Forms\LoginForm;
use Pluto\Partials\SessionManager;

class SessionsController extends BaseController {

	/**
	 * @var Acme\Forms\LoginForm
	 */
	protected $loginForm;
	protected $sessionManager;

	/**
	 * @param LoginForm $loginForm
	 */
	function __construct(LoginForm $loginForm, SessionManager $sessionManager)
	{
		$this->loginForm = $loginForm;
		$this->sessionManager = $sessionManager;
		$this->beforeFilter('guest', ['except' => ['destroy']]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('sessions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$this->loginForm->validate($input = Input::only('email', 'password'));

		if (Auth::attempt($input))
		{			
			$this->sessionManager->setupSession(Auth::user());
			return Redirect::intended('/');
		}

		return Redirect::back()->withInput()->withErrors('Invalid credentials provided');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id = null)
	{		
		//$this->sessionManager->destroySession(Auth::user());		
		Auth::logout();
		return Redirect::home();
	}

}