(function() {

    var pusher = new Pusher('c01e574cb9520fc388bc');


    var FriendRequestChannel = pusher.subscribe('FriendRequestChannel');
    FriendRequestChannel.bind('userSentRequest', function(data){         
         
            if(auth_user == data.receiver_email){
               $('.fa-user-plus').css('color','#FF6666');
                $(".icon-bar").removeClass('icon-bar-notify-white');
               $(".icon-bar").addClass('icon-bar-notify');
               $('.freq').fadeIn();
               $('.no-new-req').fadeOut();
               $('.freq').text(data.total_req);  
               console.log(data.request_id);             
                $(".friend-requests-append").prepend('<div class="friend-request-'+data.request_id+'" id="friend-req-id" >'
           
                 +'  <li>   <div class="freq-panel"> <input type="text" style="display:none;" class="sender_name-'+data.request_id+'" value="'+data.sender_name+'"/> <input type="text" style="display:none;" class="sender_link-'+data.request_id+'" value="'+data.sender_link+'"/> '
                 +'  <img src="'+data.img+'" class="avatar_tiny new_friend_avatar_id-'+data.request_id+'" alt="avatar"/> '
                 +'    '+data.sender_name+' <div class="new-friend-request-info"> '+data.gender+' <div class="accept-reject-friend-button "> '
                 +'   <div class="replace-friends-button-'+data.request_id+'"> <form method="POST" action="'+data.url+'" accept-charset="UTF-8" id="respondToFriendRequest" class="ng-pristine ng-valid">'
                 +'   <button type="submit" class="btn btn-success btn-xs respond-friend-request" id="1-'+data.request_id+'-'+data.sender_id+'"> <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></button>'
                 +'   <button type="submit" class="btn btn-danger btn-xs respond-friend-request" id="0-'+data.request_id+'-'+data.sender_id+'"> <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> </button> '
                 +' </form></div></div></div></div> </li> <li class="divider"></li>'
                 +' </div>');
          }
              //  alert("Incoming request from: "+data.message);
    });


  var RecentUpdateChannel = pusher.subscribe('RecentUpdateChannel');
   RecentUpdateChannel.bind('userDidRecent', function(data){  
       
        var url = data.url;
        var appendText = "";
        var dataString = 'user='+data.user_id+ '&type='+data.type+ '&postId='+data.post_id;        
        $.ajax({
            type: 'POST',
            url: url,
            data: dataString,
            beforeSend: function(request) {               
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
            },
            success: function(response) {  
              
                if(response != 0){

                   if((response.status_body).length > 90 ){
                      appendText = "Click to se more...";
                   }
                   $('.sidebar-no-updates').fadeOut();

                    $(".news-items-sidebar").prepend('<div class="sidebar-news-update new-update-background sidebar-news-update-'+data.root_id+' ">'

                    +'<img src="'+response.avatar+'" class="avatar_tiny img-circle" alt="avatar">'
                    +'<a href="'+response.url+'"> '+response.info.firstname+'  '+response.info.lastname+' </a>'
                    +'<small style="float:right;"> '+response.status_time+' </small>'
                    +'<div class=" col-md-offset-2 recent-updates-body-sidebar">  '+response.status_body+' <small>'+appendText+'</small> </div>'
                    +'<hr style="height:1px;"> '

                    +' </div>');
                    
                     setTimeout(function() {
                        $(".sidebar-news-update-"+data.root_id).removeClass('new-update-background');
                    },7000);
                   

                }
            },
            error: function() {}
        });
   });


var FriendMessageChannel = pusher.subscribe('FriendMessageChannel');
FriendMessageChannel.bind('newFriendMessage', function(data){ 

                var dataString = 'msg='+data.message;
                var dataString1 = 'user_id='+data.sender_id;
                var url = root+'/messages/decrypt-message'; 
                var url1 = root+'/check-Friendship';               
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: dataString,
                    beforeSend: function(request) { 
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
                    },
                    success: function(response) { 

                $.ajax({
                    type: 'POST',
                    url: url1,
                    data: dataString1,
                    beforeSend: function(request) { 
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
                    },
                    success: function(response1) {                        
                         if(response1 == 1){
                            if((token_type == "global" && data.email != auth_user) || (token_type == "group" && data.email != auth_user))
                              $(".token_friends").addClass('red-notify');

                            $(".friends-window").animate({ scrollTop: $('.friends-window')[0].scrollHeight}, 1000);
                             if(auth_user != data.email){
                                if(data.incognito == '1') {

                                     // User Incognito Mode Message
                                            
                             $(".friends-window").append('<div class="row">'
                             +' <div class="pull-left chat_img_pos_left" style="padding:0px;">'                             
                             +'   <i class="fa fa-user-secret fa-2x" style="color:#5A5A5A;"></i> </div>'

                             +'  <div class="col-md-6 pull-left Area-left" style="background-color: rgba(0, 0, 0, 0.08);">'
                             +' <div class="col-md-12" style="padding:0px;">'
                             +' <div class="col-md-8 pull-left text-left chat_username"> Unknown  </div>'                             
                             +' <div class="col-md-8 col-md-offset-1 pull-left text-left chat_time"> Just now... </div>'
                             +' <div class="col-md-12 pull-right text-center chat_text" style="border: 1px solid #F3E8E8;"> '+response+' </div>'
                             +'</div> </div>');

                                }else{

                                    // User Normal Message
                                            
                             $(".friends-window").append('<div class="row">'
                             +' <div class="col-md-1 pull-left chat_img_pos_left" style="padding:0px;">'
                             +'  <a href="'+data.user_link+'"> <img src="'+data.img+'" class="chat_img img-responsive"/>'
                             +'  <div class="tooltip"> </div> </a> </div>'

                             +'  <div class="col-md-5 pull-left Area-left">'
                             +' <div class="col-md-12" style="padding:0px;">'
                             +' <div class="col-md-8 pull-left text-left chat_username"> '+ data.firstname+' '+data.lastname +'   </div>'
                             +' <div class="col-md-2" style="font-size: 8px;"> @'+data.username+' </div>'
                             +' <div class="col-md-8 col-md-offset-1 pull-left text-left chat_time"> Just now... </div>'
                             +' <div class="col-md-12 pull-right text-center chat_text"> '+response+' </div>'
                             +'</div> </div>');

                                }

                            
                           

                          }else{

                            //My Message
                                       
                             $(".friends-window").append('<div class="row">'
                             +'  <div class="col-md-1 pull-right chat_img_pos" style="padding:0px;"> '
                             +'  <a href="'+data.user_link+'"> <img src="'+data.img+'" class="chat_img img-responsive"/>'
                             +'  <div class="tooltip"> </div> </a> </div>'

                             +'  <div class="col-md-5 pull-right Area">'
                             +' <div class="col-md-12" style="padding:0px;">'
                             +' <div class="col-md-8 pull-right text-right chat_username"> Me </div>'
                             +' <div class="col-md-2" style="font-size: 8px;">     </div>'
                             +'  <div class="col-md-8 col-md-offset-4 pull-right text-right chat_time">  Just now... </div>'
                             +' <div class="col-md-12 pull-left text-center chat_text chat_text_right"> '+response+' </div>'
                             +'</div> </div>');

                          }  

                         }
                            

                       },
                      error: function() {}
                    });                                           
                },
                    error: function() {}
    });
});










 var GlobalMessageChannel = pusher.subscribe('GlobalMessageChannel');
    GlobalMessageChannel.bind('newGlobalMessage', function(data){                 
                var dataString = 'msg='+data.message;
                var url = root+'/messages/decrypt-message';                
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: dataString,
                    beforeSend: function(request) { 
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
                    },
                    success: function(response) { 
                         if((token_type == "friends" && data.email != auth_user) || (token_type == "group" && data.email != auth_user))
                            $(".token_global").addClass('red-notify');
                      
                      $(".global-window").animate({ scrollTop: $('.global-window')[0].scrollHeight}, 1000);
                          if(auth_user != data.email){

                            // User Message
                                            
                             $(".global-window").append('<div class="row">'
                             +' <div class="col-md-1 pull-left chat_img_pos_left" style="padding:0px;">'
                             +'  <a href="'+data.user_link+'"> <img src="'+data.img+'" class="chat_img img-responsive"/>'
                             +'  <div class="tooltip"> </div> </a> </div>'

                             +'  <div class="col-md-5 pull-left Area-left">'
                             +' <div class="col-md-12" style="padding:0px;">'
                             +' <div class="col-md-8 pull-left text-left chat_username"> '+ data.firstname+' '+data.lastname +'   </div>'
                             +' <div class="col-md-2" style="font-size: 8px;"> @'+data.username+' </div>'
                             +' <div class="col-md-8 col-md-offset-1 pull-left text-left chat_time"> Just now... </div>'
                             +' <div class="col-md-12 pull-right text-center chat_text"> '+response+' </div>'
                             +'</div> </div>');
                           

                          }else{

                            //My Message
                                       
                             $(".global-window").append('<div class="row">'
                             +'  <div class="col-md-1 pull-right chat_img_pos" style="padding:0px;"> '
                             +'  <a href="'+data.user_link+'"> <img src="'+data.img+'" class="chat_img img-responsive"/>'
                             +'  <div class="tooltip"> </div> </a> </div>'

                             +'  <div class="col-md-5 pull-right Area">'
                             +' <div class="col-md-12" style="padding:0px;">'
                             +' <div class="col-md-8 pull-right text-right chat_username"> Me </div>'
                             +' <div class="col-md-2" style="font-size: 8px;">     </div>'
                             +'  <div class="col-md-8 col-md-offset-4 pull-right text-right chat_time">  Just now... </div>'
                             +' <div class="col-md-12 pull-left text-center chat_text chat_text_right"> '+response+' </div>'
                             +'</div> </div>');

                          }                     
                    },
                    error: function() {}
                });

                
               

               
               
    });



   

})(); 