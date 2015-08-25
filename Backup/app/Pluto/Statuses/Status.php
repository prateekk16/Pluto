<?php

namespace Pluto\Statuses;
use Laracasts\Commander\Events\EventGenerator;
use Pluto\Statuses\Events\StatusPublished;
use Pluto\Statuses\Status;
use Pluto\Users\User;
use Illuminate\Support\Facades\Response;

class Status extends \Eloquent {

	use EventGenerator;

	/**
	 * [$fillable fields for a  new status]
	 * @var array
	 */
	protected $fillable = ['body'];

	/**
	 * [$table description]
	 * @var string
	 */
	protected $table = 'statuses';

	/**
	 * A status belongs to user
	 * @return [type] [description]
	 */
	public function user(){
		return $this->belongsTo('Pluto\Users\User');
	}


	/**
	 * Publish a new status
	 * @param  [type] $body [description]
	 * @return [type]       [description]
	 */
	public static function publish($body){

		  $status = new static(compact('body'));

          $status->raise(new StatusPublished($body));
        
          return $status;
	}

	


}
