<?php

use Laracasts\Commander\CommanderTrait;
use Pluto\Updates\UpdateRepository;

class UpdatesController extends BaseController {

	use CommanderTrait;
	private $updateRepository;


	function __construct(UpdateRepository $updateRepository)
	{		
		$this->updateRepository = $updateRepository;
		$this->beforeFilter('auth', ['only' => ['store','show']]);
	
	}



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('updates.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('updates.create');
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
	public function show()
	{
        $type = Input::get('type');
        switch($type){
        	case 'status': 
        				    
        				   $statuses = $this->updateRepository->getStatuses( Input::get('user'), Input::get('postId'), Auth::user()->id );        
         				   return $statuses;	
        	 			   break;

        	default:	   break;

        }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('updates.edit');
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
