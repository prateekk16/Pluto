<?php

namespace Pluto\Updates;
use Laracasts\Commander\Events\EventGenerator;
use Pluto\Updates\Events\UpdatePublished;
use Pluto\Statuses\Status;

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

          $update->raise(new UpdatePublished($user_id,$type,$post_id));
        
          return $update;
	}


	public static function MyFriendsUpdates($user){
		$updates = Update::all();
		$mixed = array();

		foreach($updates as $update){
		   if(checkFriendship($user,$update->user_id)){
		   	 switch($update->type){
				case 'status': 
						       $status = Status::where('id',$update->post_id)->first();
						       $mixed['body'] = $status->body;
						       break;

			    default:       break;						       


			}
		   }
			
		}

		return $mixed;
	}


}
