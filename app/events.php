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


 Event::listen('Pluto.FriendRequests.Events.FriendRequestPublished', function($event){
	
	$sender =   getUser($event->sender_id);
	$receiver = getUser($event->receiver_id);
	$total_requests = getTotalRequests($event->receiver_id);
	
    Pusherer::trigger('FriendRequestChannel', 'userSentRequest', array( 'sender_email' => $sender->email, 'receiver_email' => $receiver->email, 'sender_name' => $sender->info->firstname.' '.$sender->info->lastname, 'total_req' => $total_requests->count() ));
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