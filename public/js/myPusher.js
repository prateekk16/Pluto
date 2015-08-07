(function() {

    var pusher = new Pusher('c01e574cb9520fc388bc');
    var channel = pusher.subscribe('FriendRequestChannel');
    channel.bind('userSentRequest', function(data){
          var user = $("#userEmail").val();
            if(user == data.receiver_email){
               $('.fa-users').css('color','#e72c2c');
                $(".icon-bar").removeClass('icon-bar-notify-white');
               $(".icon-bar").addClass('icon-bar-notify');
               $('.freq').fadeIn();
               $('.freq').text(data.total_req);

                $(".friend-requests-append").prepend('<div class="friend-request-'+data.sender_id+'">'
           
                 +'  <li>   <div class="freq-panel">  <img src="'+data.img+'" class="avatar_small" alt="avatar"/> '
                 +'    '+data.sender_name+' <div class="new-friend-request-info"> '+data.gender+' <div class="accept-reject-friend-button "> '
                 +'   <div class="replace-friends-button-'+data.sender_id+'"> <form method="POST" action="'+data.url+'" accept-charset="UTF-8" id="respondToFriendRequest" class="ng-pristine ng-valid">'
                 +'   <button type="submit" class="btn btn-success btn-xs respond-friend-request" id="1-'+data.sender_id+'"> <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span></button>'
                 +'   <button type="submit" class="btn btn-danger btn-xs respond-friend-request" id="0-'+data.sender_id+'"> <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> </button> '
                 +' </form></div></div></div></div> </li> <li class="divider"></li>'
                 +' </div>');
          }
              //  alert("Incoming request from: "+data.message);
    });


  // var channel = pusher.subscribe('StatusUpdateChannel');
  //  channel.bind('userChangedStatus', function(data){        
  //       var url = data.url;
  //       var dataString = 'user='+data.user_id+ '&type='+data.type+ '&postId='+data.post_id;
  //       $.ajax({
  //           type: 'POST',
  //           url: url,
  //           data: dataString,
  //           beforeSend: function(request) {               
  //               return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
  //           },
  //           success: function(response) {                
  //               if(response!=0){
                   
  //               }
  //           },
  //           error: function() {}
  //       });
  //  });



   

})(); 