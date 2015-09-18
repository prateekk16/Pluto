<?php

namespace Pluto\Partials;

use Pluto\Users\User;
use Pluto\Users\UserBrowsingInfo;


class BrowsingInfo{


public function setBrowsingInfo(User $user){
	      $browsing = new UserBrowsingInfo;
		  $browsing->user_id = $user->id;
		  $browsing->last_login = \DB::raw('CURRENT_TIMESTAMP');
 		  $browsing->last_global_post_read = $this->lastGlobalMessageId();
		  $browsing->save();
		  return $user;
}

public function getBrowsingInfo(User $user){
	     return UserBrowsingInfo::where('user_id',$user->id)->firstOrFail();
}

public function lastGlobalMessageId(){
		$last_global_id = 0;
		$last_global = getLastGlobalMessageId();
		if($last_global != null) $last_global_id = $last_global->id;
		return $last_global_id;
	}

public function updateBrowsingInfo(User $user,UserBrowsingInfo $browsing){	 
	 $browsing->last_login = \DB::raw('CURRENT_TIMESTAMP');
	 $browsing->last_global_post_read = $this->lastGlobalMessageId();
	 $browsing->save();
	 return $user;

}




}