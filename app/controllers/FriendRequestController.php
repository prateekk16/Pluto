<?php

use Pluto\Forms\EmailValidate;
use Laracasts\Commander\CommanderTrait;
use Pluto\FriendRequests\PublishFriendRequestCommand;

class FriendRequestController extends BaseController {

	use CommanderTrait;

	/**
	 * [$statusForm description]
	 * @var [type]
	 */
	private $validation;


	function __construct(EmailValidate $validation)
	{
		$this->validation = $validation;
		$this->beforeFilter('auth', ['only' => ['create','store']]);
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('friendrequests.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$email = Input::get('email');		
		$input['email'] = $email;
		$this->validation->validate($input);
	    $input = array_merge($input, ['senderEmail' => Auth::user()->email]);		
		$request = $this->execute(PublishFriendRequestCommand::class, $input);

		return 1;
       
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('friendrequests.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('friendrequests.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
