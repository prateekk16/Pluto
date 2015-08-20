(function() {

    var pusher = new Pusher('c01e574cb9520fc388bc');


    var FriendRequestChannel = pusher.subscribe('FriendRequestChannel');
    FriendRequestChannel.bind('userSentRequest', function(data){
          var user = $("#userEmail").val();
            if(user == data.receiver_email){
               $('.fa-users').css('color','#e72c2c');
                $(".icon-bar").removeClass('icon-bar-notify-white');
               $(".icon-bar").addClass('icon-bar-notify');
               $('.freq').fadeIn();
               $('.freq').text(data.total_req);

                $(".friend-requests-append").prepend('<div class="friend-request-'+data.sender_id+'">'
           
                 +'  <li>   <div class="freq-panel"> <input type="text" style="display:none;" class="sender_name-'+data.sender_id+'" value="'+data.sender_name+'"/> <input type="text" style="display:none;" class="sender_link-'+data.sender_id+'" value="'+data.sender_link+'"/> '
                 +'  <img src="'+data.img+'" class="avatar_small new_friend_avatar_id-'+data.sender_id+'" alt="avatar"/> '
                 +'    '+data.sender_name+' <div class="new-friend-request-info"> '+data.gender+' <div class="accept-reject-friend-button "> '
                 +'   <div class="replace-friends-button-'+data.sender_id+'"> <form method="POST" action="'+data.url+'" accept-charset="UTF-8" id="respondToFriendRequest" class="ng-pristine ng-valid">'
                 +'   <button type="submit" class="btn btn-success btn-xs respond-friend-request" id="1-'+data.sender_id+'"> <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></button>'
                 +'   <button type="submit" class="btn btn-danger btn-xs respond-friend-request" id="0-'+data.sender_id+'"> <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> </button> '
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


 var GlobalMessageChannel = pusher.subscribe('GlobalMessageChannel');
    GlobalMessageChannel.bind('newGlobalMessage', function(data){
                var user = $("#userEmail").val();
                var dataString = 'msg='+data.message;
                var url = $("#decrypt-message").val();
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: dataString,
                    beforeSend: function(request) {                       
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
                    },
                    success: function(response) {                
                        $(".global-window").animate({ scrollTop: $('.global-window')[0].scrollHeight}, 1000);
                          if(user == data.email){
                                            
                             $(".global-window").append('<div class="row">'
                             +'<div class="col-md-7 pull-right Area"> <div class="col-md-2 pull-right chat_img_pos">'
                             +' <a href="'+data.user_link+'">'
                             +'<img src="'+data.img+'" class="chat_img"/>   <div class="tooltip">  </div> </a> </div>'
                             +'<div class="col-md-3 chat_time pull-right"> <span class="chat_username"> '+data.username+' </span><br/> just now... </div>  '
                             +'<div class="col-md-10 chat_text"> '+response+' </div> </div>'
                             +' </div>');  

                          }else{
                                       
                             $(".global-window").append('<div class="row">'
                             +'<div class="col-md-7 pull-left Area"> <div class="col-md-2 pull-right chat_img_pos">'
                             +' <a href="'+data.user_link+'">'
                             +'<img src="'+data.img+'" class="chat_img"/>   <div class="tooltip">  </div> </a> </div>'
                             +'<div class="col-md-3 chat_time pull-right"> <span class="chat_username"> '+data.username+' </span><br/> just now... </div>  '
                             +'<div class="col-md-10 chat_text"> '+response+' </div> </div>'
                             +' </div>');  

                          }                     
                    },
                    error: function() {}
                });

                
               

               
               
    });



   

})(); 