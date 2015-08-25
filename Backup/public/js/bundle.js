 $(document).ready(function(){

    $('[data-toggle=offcanvas]').click(function() {
    $(this).toggleClass('visible-xs text-center');
    $(this).find('i').toggleClass('glyphicon-chevron-right glyphicon-chevron-left');
    $('.row-offcanvas').toggleClass('active');
    $('#lg-menu').toggleClass('hidden-xs').toggleClass('visible-xs');
    $('#xs-menu').toggleClass('visible-xs').toggleClass('hidden-xs');
    $('#btnShow').toggle();
});


     $(".global-window").animate({ scrollTop: $('.global-window')[0].scrollHeight}, 1000);
     $('ul.pagination:visible').hide(); 
       $('.news-items-sidebar').jscroll({
        debug: true,
        autoTrigger: true,
        nextSelector: '.pagination li.active + li a', 
        contentSelector: '.sidebar-news-update',
        callback: function() {
            $('ul.pagination:visible').hide();
        }
    });

        
    });

$( ".profile-pic-sidebar" ).hover(
          function() {
            $(".change_dp_sidebar").fadeIn();
          }, function() {
            $(".change_dp_sidebar").fadeOut();
          }
        );




//  jQuery(window).ready(function(){
//             jQuery("#btnInit").click(initiate_geolocation);
//         });
 
//         function initiate_geolocation() {
//             navigator.geolocation.getCurrentPosition(handle_geolocation_query,handle_errors);
//         }
 
//         function handle_errors(error)
//         {
//             switch(error.code)
//             {
//                 case error.PERMISSION_DENIED: alert("user did not share geolocation data");
//                 break;
 
//                 case error.POSITION_UNAVAILABLE: alert("could not detect current position");
//                 break;
 
//                 case error.TIMEOUT: alert("retrieving position timed out");
//                 break;
 
//                 default: alert("unknown error");
//                 break;
//             }
//         }
 
//         function handle_geolocation_query(position)
// {
//     var image_url = "http://maps.google.com/maps/api/staticmap?sensor=false&center=" + position.coords.latitude + "," +
//                     position.coords.longitude + "&zoom=18&size=300x400&markers=color:blue|label:S|" +
//                     position.coords.latitude + ',' + position.coords.longitude;

//     $("#newMap").append(
//         jQuery(document.createElement("img")).attr("src", image_url).attr('id','map')
//     );
// }



$("#left-sidebar-notify").click(function(event){   
   $(".icon-bar-notify").addClass('icon-bar-notify-white');
});

$(document).on("click", '.click-me',function(event){
    alert("ok");
     $("#newMap").append(' <button type="submit" class="click-me"/> ');
});



   

/**
 * Post a Status
 */

$("#postStatus").submit(function(event) {
    event.preventDefault();
    var url = $(this).attr('action');
    var dataString = 'body=' + $(".status-body").val();
    if ($(".status-body").val() != "") {
        $.ajax({
            type: 'POST',
            url: url,
            data: dataString,
            beforeSend: function(request) {
                $("#postStatusBtn").attr("disabled", true);
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
            },
            success: function(response) {                
                $(".user_nav_status").text(response);
                $("#postStatusBtn").attr("disabled", false);
                $(".status-body").val("");
            },
            error: function() {}
        });
    }
});

/**
 * BroadCast a Global Message
 */

$("#sendGlobal").submit(function(event) {
    event.preventDefault();
    var url = $(this).attr('action');
    var dataString = 'message=' + $(".global_message_body").val();
    if ($(".global_message_body").val() != "") {
        $.ajax({
            type: 'POST',
            url: url,
            data: dataString,
            beforeSend: function(request) {
                $(".global_send_button").attr("disabled", true);
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
            },
            success: function(response) {   
                         
                $(".global_send_button").attr("disabled", false);
                $(".global_message_body").val("");
            },
            error: function() {}
        });
    }
});




/**
 * Upload AVATAR
 */

$("#uploadAvatar").submit(function(event) {
    event.preventDefault();
    var file = $("#choose-avatar").prop('files')[0];
    var url = $(this).attr('action');
    if (file == null) {
        swal('Oops...', 'Please select a file...', 'error');
        return false;
    } else {
        $.ajax({
            type: 'POST',
            url: url,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function(request) {
                $("#uploadAvatar-btn").attr("disabled", true);
                $(".uploadAvatar-btn-text").text("Please wait...");
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
            },
            success: function(response) {
                $("#uploadAvatar-btn").attr("disabled", false);
                $(".uploadAvatar-btn-text").text("Upload");
                $('.change-dp-modal').modal('hide');
                d = new Date();
                $(".avatar_sidebar").attr('src', response + d.getTime());
            },
            error: function() {}
        });
        return true;
    }
});

/**
 * Send Friend Request with Email Address
 */

$("#sendFriendEmailRequest").submit(function(event) {
    event.preventDefault();
    var url = $(this).attr('action');
    var userEmail = $("#userEmail").val();
    //var dataString = 'body=' + $(".status-body").val();
    if ( ($(".add-friend-email").val() != "") && ($(".add-friend-email").val() != userEmail )) {
        $.ajax({
            type: 'POST',
            url: url,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function(request) {
                $("#addFriendsEmail").attr("disabled", true);
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
            },
            success: function(response) { 

                if(response == 1){
                     $("#addFriendsEmail").attr("disabled", false);
                     $(".add-friend-email").val("");
                     swal({   title: 'Done!',   text: 'Friend Request Sent',   timer: 1000 });
                } else {
                     $("#addFriendsEmail").attr("disabled", false);
                     $(".add-friend-email").val("");
                     swal(   'Error!',   response ,   'error' );
                }               
               
            },
            error: function() {}
        });
    }
});

$(document).on("click", '.respond-friend-request',function(event){

    event.preventDefault();    
    event.stopPropagation();   
    
    var url = $("#respondToFriendRequest").attr('action');    
    var id = $(this).attr('id');
    var arr = id.split('-');
    id = arr[1];
    var response = arr[0]; 
    var dataString = 'id='+id + '&response='+response;
    var imgsrc = $(".new_friend_avatar_id-"+id).attr('src');
    var name = $('.sender_name-'+id).val();
    var senderLink = $('.sender_link-'+id).val();

     $.ajax({
            type: 'POST',
            url: url,
            data: dataString,           
            beforeSend: function(request) {
                $(".accept-friend-request").attr("disabled", true);
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
            },
            success: function(res) {
                if(res == 0 ){
                    $(".badge-freq").fadeOut();
                    $(".fa-users-freq").css("color", '#337ab7');
                  }               
               $(".freq").text(res);

               if(response == 0){                 
                   $("#1-"+id).fadeOut(200);
                   $("#0-"+id).attr("disabled",true);
               } else{ 
                   $("#0-"+id).fadeOut(200);
                   $("#1-"+id).attr("disabled",true);

                   var count =  $('.count-total-friends-sidebar').val();  
                   count += 1;                 
                   $('.count-total-friends-sidebar').text(count);
                   $('.total-friends-list-sidebar').prepend('<div class="my-friends-list-sidebar">'
                    +'<img src="'+imgsrc+'" class="avatar_tiny img-circle" alt="avatar">'
                    +'<a href="'+senderLink+'"> '+name+'  </a>'
                   +' </div>');
               }
             
            },
            error: function() {}
        });


    // var total =  $(".total-friend-requests").children().length;
    


});


/**
 * Angular App
 * @type {[type]}
 */
app = angular.module('pluto', []);
app.config(['$interpolateProvider', function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}]);
app.controller('StatusController', ['$http', '$scope', function($http, $scope) {
    $http.get('/status/user').success(function(result) {
        $scope.statuses = result;
    });
}]);