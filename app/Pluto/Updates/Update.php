<?php

namespace Pluto\Updates;
use Laracasts\Commander\Events\EventGenerator;
use Pluto\Updates\Events\UpdatePublished;

class Update extends \Eloquent {

	use EventGenerator;

	/**
	 * [$fillable fields for a  new status]
	 * @var array
	 */
	protected $fillable = ['user_id','post_id','type'];

	/**
	 * [$table description]
	 * @var string
	 */
	protected $table = 'news_updates';

	


	/**
	 * Publish a new status
	 * @param  [type] $body [description]
	 * @return [type]       [description]
	 */
	public static function publish($user_id,$type,$post_id){

		  $update = new static(compact('user_id','type','post_id'));

        //  $status->raise(new StatusPublished($body));
        
          return $update;
	}


}
