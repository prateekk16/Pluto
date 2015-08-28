<?php

use Pluto\Users\UserInfo;
use Pluto\Users\User;
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

	/**
	 * [appendValue description]
	 * @param  [type] $data    [description]
	 * @param  [type] $type    [description]
	 * @param  [type] $element [description]
	 * @return [type]          [description]
	 */
	public function appendValue($data,$element)
	{
		// operate on the item passed by reference, adding the element and type
		foreach ($data as $key => & $item) {

			  $id = 	$item['user_id'];		
			  $item[$element] = checkFriendship($id , Auth::user()->id );
		}
		return $data;		
	}

	public function friends($user)
	{
	
		foreach ($user as $key => & $item) {
			//$email = $u['user']['email'];
			if( checkFriendship($item['user_id'] , Auth::user()->id) == 0 ){
				$item['check'] = 'Not Friends';
				unset($user[$key]);
			}else{
				$item['check'] = 'Friends';
			}
		}
		
		return array_values($user);	
	}


	public function friendSearch()
	{

		    // Retrieve the user's input and escape it
			$query = e(Input::get('q',''));



			// If the input is empty, return an error response
			if(!$query && $query == '') return Response::json(array(), 400);

			$user = UserInfo::where('firstname','like','%'.$query.'%')
							->orWhere('lastname','like','%'.$query.'%')
							->with('user')
							->orderBy('firstname','asc')
							->take(6)
							->get()->toArray();

			$user = $this->friends($user);

			//$user = $this->appendValue($user,'check');  

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
