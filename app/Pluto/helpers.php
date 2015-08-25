<?php
use Pluto\Users\User;
use Pluto\FriendRequests\FriendRequest;
use Pluto\Updates\Update;
use Pluto\Statuses\Status;
use Pluto\Messenger\Models\Thread;
use Pluto\Messenger\Models\Message;
use Pluto\Messenger\Models\Participant;
use Carbon\Carbon;

function errors_for($attribute, $errors)
{
	return $errors->first($attribute, '<span class="error">:message</span>');
}
function link_to_profile($text = 'Profile')
{
    return link_to_route('profile', $text, Auth::user()->username);
}

function getLatestStatus(){
	return Auth::user()->statuses()->orderBy('created_at','desc')->first();
}

function getFriendRequests(){
	return FriendRequest::getFriendRequests(Auth::user()->id);
}

function getUserObject($id){
	return User::where('id',$id)->firstOrFail();
}

function getMyFriends(){
	 return FriendRequest::MyFriends(Auth::user()->id);
}

function getMyFavourites($count){
    return Auth::user()->favourites()->take($count)->get();
}

function getMyFriendsUpdatesRecent(){
	 return Update::MyFriendsUpdatesRecent(Auth::user()->id);
}

function getStatusById($id){
	return Status::where('id',$id)->firstOrFail();
}


function getGlobalMessages(){
	
	 $messages = Message::getAllLatestGlobal();
	 return $messages;
	
}

function decryptMessage($msg){
   return Message::decryptMain($msg);
}

function createThreads(){
	$thread = Thread::create(
            [
                'subject' => "Check",
            ]
        );

        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'body'      => "Hellooooo.",
            ]
        );

        // Sender
        Participant::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'last_read' => new Carbon
            ]
        );

        // Recipients
        
}





/**
 * Helper Functions used in Events.php
 */

/**
 * Get User Object
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
 function getUser($id){
	return User::with('info')->whereId($id)->firstOrFail();
}

function getTotalRequests($receiver_id){
	return FriendRequest::where('receiver_id','=',$receiver_id)
                                            ->where('pending','=',1)->get();
}

function checkUserAvatar($email,$size){
	if((file_exists('img/users/'.$email.'/avatar_'.$size.'.jpg')))
		 $img = 'img/users/'.$email.'/avatar_'.$size.'.jpg';
    else
    	 $img = 'img/blank_'.$size.'.jpg';

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

function getUpdateObject($type,$user,$postId){

	return Update::where('user_id',$user)
				 ->where('type',$type)
				 ->where('post_id',$postId)->first();	

}




