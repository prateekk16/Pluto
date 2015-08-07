 <?php
use Pluto\FriendRequests\FriendRequest;
#Events

// Event::listen('Pluto.Registration.Events.UserRegistered', function($event){

// 		dd('Send a notification');
// });
// 
Event::listen('Pluto.Statuses.Events.StatusPublished', function($event){
	// echo $event->body;
});

Event::listen('Pluto.Updates.Events.UpdatePublished', function($event){
	// $sender =   getUser(1);
	// $receiver = getUser(2);
	// $total_requests = getTotalRequests(2);
	// $img = checkUserAvatar('prateekk16@gmail.com');
	// $gender = "Male";
	// $url = Request::root().'/respond-to-friend-request';
	
	
 //    Pusherer::trigger('FriendRequestChannel', 'userSentRequest', array('sender_id' => '1', 'img' => $img, 'url' => $url,  'gender' => $gender,  'sender_email' => 'prateekk16@gmail.com', 'receiver_email' => 'admin@admin.com', 'sender_name' => 'Prateek Singh', 'total_req' => $total_requests->count() ));
   $url = Request::root().'/news-update-check-friendship';
   Pusherer::trigger('StatusUpdateChannel','userChangedStatus',array('url'=>$url, 'user_id' => $event->user_id, 'type' => $event->type, 'post_id' => $event->post_id ));

});


 Event::listen('Pluto.FriendRequests.Events.FriendRequestPublished', function($event){
	
	$sender =   getUser($event->sender_id);
	$receiver = getUser($event->receiver_id);
	$total_requests = getTotalRequests($event->receiver_id);
	$img = checkUserAvatar($sender->email);
	$gender = $sender->info->gender;
	$url = Request::root().'/respond-to-friend-request';
	
	
    Pusherer::trigger('FriendRequestChannel', 'userSentRequest', array('sender_id' => $sender->id, 'img' => $img, 'url' => $url,  'gender' => $gender,  'sender_email' => $sender->email, 'receiver_email' => $receiver->email, 'sender_name' => $sender->info->firstname.' '.$sender->info->lastname, 'total_req' => $total_requests->count() ));
 });















/**
 * Helper Functions
 */

/**
 * Get User Object
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
 function getUser($id){
	return User::where('id',$id)->firstOrFail();
}

function getTotalRequests($receiver_id){
	return FriendRequest::where('receiver_id','=',$receiver_id)
                                            ->where('pending','=',1)->get();
}

function checkUserAvatar($email){
	if((file_exists('img/users/'.$email.'/avatar_small.jpg')))
		 $img = 'img/users/'.$email.'/avatar_small.jpg';
    else
    	 $img = 'img/blank_small.jpg';

    return $img; 
}

function checkFriendship($user1,$user2){

	$check = FriendRequest::where('receiver_id',$user1)
							  ->where('sender_id',$user2)
 							  ->where('pending','0')->first();

 		if($check == null){
 			$check = FriendRequest::where('receiver_id',$user2)
							  ->where('sender_id',$user1)
 							  ->where('pending','0')->first();
 		}

	 	if($check != null){
	 	  	return 1;
	 	 }

 	  return 0;
}




