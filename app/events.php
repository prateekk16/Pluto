 <?php
use Pluto\FriendRequests\FriendRequest;
use Pluto\Updates\Update;
#Events

// Event::listen('Pluto.Registration.Events.UserRegistered', function($event){

// 		dd('Send a notification');
// });
// 
Event::listen('Pluto.Statuses.Events.StatusPublished', function($event){
	// echo $event->body;
});

Event::listen('Pluto.Messenger.Events.GlobalMessagePublished', function($event){
      
	   $sender =   getUser($event->user_id);
	   $userLink = Request::root().'/'.$sender->username;
	   $img = checkUserAvatar($sender->email,'small');  

	   Pusherer::trigger('GlobalMessageChannel', 'newGlobalMessage', array('email'=>$sender->email,  'message' => $event->body, 'user_link' => $userLink, 'img' => $img, 'username'=>$sender->username  ));
 
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
   $update = getUpdateObject($event->type,$event->user_id,$event->post_id);
   switch($event->type){

   	case 'status': Pusherer::trigger('RecentUpdateChannel','userDidRecent',array('root_id'=>$update->id, 'url'=>$url, 'user_id' => $event->user_id, 'type' => $event->type, 'post_id' => $event->post_id ));
   				   break;

   	default:
   			break;	
   }
   
});


 Event::listen('Pluto.FriendRequests.Events.FriendRequestPublished', function($event){
	
	$sender =   getUser($event->sender_id);
	$receiver = getUser($event->receiver_id);
	$total_requests = getTotalRequests($event->receiver_id);
	$img = checkUserAvatar($sender->email,'small');
	$gender = $sender->info->gender;
	$url = Request::root().'/respond-to-friend-request';
	$userpage = Request::root().'/'.$sender->username;
	
    Pusherer::trigger('FriendRequestChannel', 'userSentRequest', array('request_id' =>$event->request_id,  'sender_link' => $userpage,  'sender_id' => $sender->id, 'img' => $img, 'url' => $url,  'gender' => $gender,  'sender_email' => $sender->email, 'receiver_email' => $receiver->email, 'sender_name' => $sender->info->firstname.' '.$sender->info->lastname, 'total_req' => $total_requests->count() ));
 });


















