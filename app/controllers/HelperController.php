<?php

class HelperController extends BaseController {

	

	public function decryptMessage()
	{
		return decryptMessage(Input::get('msg'));
	}


}
