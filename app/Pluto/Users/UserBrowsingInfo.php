<?php

namespace Pluto\Users;
use Laracasts\Commander\Events\EventGenerator;
use Pluto\Statuses\Events\StatusPublished;


class UserBrowsingInfo extends \Eloquent {

	use EventGenerator;

	/**
	 * [$fillable fields for a  new status]
	 * @var array
	 */
	protected $fillable = ['user_id','last_login','last_global_post_read','last_friends_post_read'];

	/**
	 * [$table description]
	 * @var string
	 */
	protected $table = 'userBrowsingInfo';

	/**
	 * A status belongs to user
	 * @return [type] [description]
	 */
	public function user(){
		return $this->belongsTo('Pluto\Users\User');
	}



}
