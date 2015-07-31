 <?php

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
	
    Pusherer::trigger('FriendRequestChannel', 'userSentRequest', array( 'message' => $receiver->email ));
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