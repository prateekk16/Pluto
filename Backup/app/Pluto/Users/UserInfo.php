<?php

namespace Pluto\Users;
use Laracasts\Commander\Events\EventGenerator;
use Pluto\Statuses\Events\StatusPublished;


class UserInfo extends \Eloquent {

	use EventGenerator;

	/**
	 * [$fillable fields for a  new status]
	 * @var array
	 */
	protected $fillable = ['firstname','lastname','gender','user_id'];

	/**
	 * [$table description]
	 * @var string
	 */
	protected $table = 'user_info';

	/**
	 * A status belongs to user
	 * @return [type] [description]
	 */
	public function user(){
		return $this->belongsTo('Pluto\Users\User');
	}


	  

	   public static function register($firstname,$lastname,$gender,$user_id){	   	  

         $user = new static(compact('firstname','lastname','gender','user_id'));
       //  $user->raise(new UserInfoRegistered($user));        
         return $user;

   	 }


}
