<?php

namespace Pluto\Uploads;
use Pluto\Users\User;
use Pluto\Uploads\Models\Upload;

class UploadRepository{	
	
	public function save(Upload $upload){
		return $upload->save();		
	}


}