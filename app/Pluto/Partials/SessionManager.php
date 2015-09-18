<?php

namespace Pluto\Partials;

use Pluto\Users\User;
use Pluto\Partials\BrowsingInfo;

class SessionManager{

	protected $browsingInfo;

function __construct(BrowsingInfo $browsingInfo)
	{
		$this->browsingInfo = $browsingInfo;
		
	}
	
	/**
	 * Get all Status
	 * @param  User   $user [description]
	 * @return [type]       [description]
	 */
	public function setupSession(User $user){		  
		  $user->online = '1';
		  $user->save();		 

		  $browser = $this->browsingInfo->getBrowsingInfo($user);
		   if($browser == null)
             $user = $this->browsingInfo->setBrowsingInfo($user);
           else
           	$user = $this->browsingInfo->updateBrowsingInfo($user, $browser);
		  return $user;
	}

	public function destroySession(User $user){
		  $user->online = '0';
		  $user->save();

		  $browser = $this->browsingInfo->getBrowsingInfo($user);
		  if($browser != null ){
			  $browser->last_global_post_read = $this->browsingInfo->lastGlobalMessageId();
			  $browser->save();			  
			}
			\Session::flush();
		  return $user;
	}

	

	

	

	


}