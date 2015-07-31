(function() {

    var pusher = new Pusher('c01e574cb9520fc388bc');
    var channel = pusher.subscribe('FriendRequestChannel');
    channel.bind('userSentRequest', function(data){
         // var user = $("#userEmail").val();
         //   if(user == data.receiver_email){
         //      $('.fa-users').css('color','#e72c2c');
         //      $('.freq').fadeIn();
         //      $('.freq').text(data.total_req);
         //   }
              //  alert("Incoming request from: "+data.message);
    });

})(); 