<?php

use Pluto\Users\UserInfo;
class ApiSearchController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('apisearches.index');
	}

	public function friendSearch()
	{

			

		    // Retrieve the user's input and escape it
			$query = e(Input::get('q',''));



			// If the input is empty, return an error response
			if(!$query && $query == '') return Response::json(array(), 400);

			$user = UserInfo::where('firstname','like','%'.$query.'%')
							->orWhere('lastname','like','%'.$query.'%')
							->orderBy('firstname','asc')
							->take(5)
							->get()->toArray();


			

			

			// Normalize data
			// Add type of data to each item of each set of results
			// Merge all data into one array
			//$data = array_merge($user);

			return Response::json(array(
				'data'=>$user
			));




	}



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('apisearches.create');
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
        return View::make('apisearches.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('apisearches.edit');
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
