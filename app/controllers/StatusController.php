<?php

use Pluto\Forms\StatusForm;
use Laracasts\Commander\CommanderTrait;
use Pluto\Statuses\PublishStatusCommand;

class StatusController extends BaseController {
	use CommanderTrait;

	/**
	 * [$statusForm description]
	 * @var [type]
	 */
	private $statusForm;


	function __construct(StatusForm $statusForm)
	{
		$this->statusForm = $statusForm;

		$this->beforeFilter('auth', ['only' => ['store']]);
	
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('statuses.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('statuses.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		 $input = Input::only('body');
		 $this->statusForm->validate($input);

		 $userId = Auth::user()->id;
		 $userId = (string)$userId;


		 $command = new PublishStatusCommand($input,$userId);
		 $status = $this->execute($command);

		 return Redirect::refresh();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('statuses.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('statuses.edit');
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
