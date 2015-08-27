<?php
class PagesController extends BaseController {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{		
		return Auth::check() ?  View::make('pages.index2') :  View::make('pages.index');		
		 
	}

}

?>

	