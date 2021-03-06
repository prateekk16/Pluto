<?php

use Pluto\Forms\ProfileForm;
use Laracasts\Commander\CommanderTrait;
use Pluto\Users\PublishProfilePicture;
use Pluto\Statuses\StatusRepository;
use Pluto\Users\UserInfo;

class ProfilePictureController extends BaseController {

	  	use CommanderTrait;

	  	private $profileForm;

	  	function __construct(ProfileForm $profileForm)
	{
		$this->profileForm = $profileForm;	
		$this->beforeFilter('auth', ['only' => ['store']]);
	
	}
             

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('profilepictures.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('profilepictures.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$path = public_path();
        $parentDir = $path.'/img/users/'.Auth::user()->email.'/';   

		  if(!is_dir($parentDir)){
		  	   return "Error";
		  }  

             if (Input::hasFile('avatar'))
            {
                if(Input::file('avatar')->isValid())
                {
                    $file = Input::file('avatar'); 
                    if(substr($file->getMimeType(), 0, 5) == 'image') {
                        // this is an image
                        $img =   Image::make($file); 
                        $img = (string) Image::make($img)->encode('jpg', 100);

                        Image::make($img)->save($parentDir.'avatar_orig.jpg');           

                       Image::make($img)->resize(255, 250, function ($constraint) {
                                    $constraint->aspectRatio();
                                    $constraint->upsize();
                                    })->save($parentDir.'avatar_big.jpg');

                       Image::make($img)->resize(155, 150, function ($constraint) {
                                    $constraint->aspectRatio();
                                    $constraint->upsize();
                                    })->save($parentDir.'avatar_med.jpg');

                       Image::make($img)->resize(50, 50, function ($constraint) {
                                     $constraint->aspectRatio();
                                     $constraint->upsize();
                                     })->save($parentDir.'avatar_small.jpg'); 

                       	$image_url = UserInfo::where('user_id',Auth::user()->id)->firstOrFail();
                       	if($image_url){
                       		$image_url->image_url = '../img/users/'.Auth::user()->email.'/avatar_med.jpg';
                       		$image_url->save();
                       	}
                       return './img/users/'.Auth::user()->email.'/avatar_med.jpg?';
                       	
                    }else{
                    	return "Error";
                    }  
                }else{
                    	return "Error";
                } 
            }else{
                    	return "Error";
           } 
         
             
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('profilepictures.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('profilepictures.edit');
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
