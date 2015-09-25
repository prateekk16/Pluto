<?php

use Pluto\Uploads\PublishFriendsUploadCommand;
use Laracasts\Commander\CommanderTrait;

class UploadsController extends BaseController {

	use CommanderTrait;
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('uploads.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('uploads.create');
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

	// Token = 2
	public function friends(){
		$destination = public_path().'/Uploads'.'/'.Auth::user()->email;

		if (!file_exists($destination)) {
			    mkdir($destination, 0777, true);
		 }
		 $filename = date("Ymd His");
		 $ext = Input::file('file')->getClientOriginalExtension();
		 $finalName = $filename.'.'.$ext;
		 $upload_success= Input::file('file')->move($destination, $finalName);
         

		 $input = array_merge(['user_id' => Auth::user()->id, 'global' => '2', 'file' => $finalName ]);		
		 $message = $this->execute(PublishFriendsUploadCommand::class, $input);		
		 return $message;
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('uploads.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('uploads.edit');
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
