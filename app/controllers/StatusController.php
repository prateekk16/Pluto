<?php

use Pluto\Forms\StatusForm;
use Laracasts\Commander\CommanderTrait;
use Pluto\Statuses\PublishStatusCommand;
use Pluto\Statuses\StatusRepository;

class StatusController extends BaseController {
	use CommanderTrait;

	/**
	 * [$statusRepository description]
	 * @var [type]
	 */
	private $statusRepository;

	/**
	 * [$statusForm description]
	 * @var [type]
	 */
	private $statusForm;


	function __construct(StatusForm $statusForm, StatusRepository $statusRepository)
	{
		$this->statusForm = $statusForm;
		$this->statusRepository = $statusRepository;

		$this->beforeFilter('auth', ['only' => ['store']]);
	
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
         $statuses = $this->statusRepository->getAllForUser(Auth::user());
        
         return $statuses;
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
		  $input = array_merge($input, ['userId' => Auth::user()->id]);			
		  $status = $this->execute(PublishStatusCommand::class, $input);

		  return $status->body;	  
		 
		 
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
       return "OK";
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
