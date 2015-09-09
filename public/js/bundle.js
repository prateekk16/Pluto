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
   $("html, body").animate({ scrollTop: $(document).height() - 50 }, "slow");

   // root+'/api/friendSearch',

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



       $('.modal').on('shown.bs.modal', function() {  
            $(".modal input").focus();          
            $(this).find('[autofocus]').focus();
        });

        $('#look-up').selectize({               
                
                openOnFocus : false,
                closeAfterSelect : true,   
                maxItems: 6,          
                valueField: ['username'],
                labelField: ['firstname'], 
                searchField: ['firstname','lastname','username'], 
                maxOptions: 10,  
                options: [], 
                create: false,                 
                render: { 
                     option: function (data, escape) {
                        return '<div class="col-md-12" style="border-bottom: 1.0pt solid #CCC;height:66px;" >'+
                        ' <div class="col-md-2 pull-left"> '+
                        ' <img src="'+data.image_url+'" class="avatar_filter_black avatar_search_box"/>'+
                        ' </div> '+                        
                        ' <div class="col-md-10"> '+
                        '<h5>' +escape(data.firstname)+' '+escape(data.lastname)+ '</h5>'+
                        '<h6>@'+escape(data.user.username)+'</h6>'+ 
                        '</div>'+
                        '</div>';
                     }
                },               
                load: function(query, callback) {
                    if (!query.length) return callback();
                    var type= "All"; 
                    if( $("#look-up").hasClass('Friends')) type="Friends";              
                               
                    $.ajax({
                        url: root+'/api/lookUp/'+type,
                        type: 'GET',
                        dataType: 'json',
                        contentType: "application/json; charset=utf-8",
                        data: {
                            q: query
                        },
                        beforeSend: function(request) {
                            return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
                        },
                        error: function(e) {                      
                            callback();
                        },
                        success: function(res) {                                                                                      
                            callback(res.data);
                        }
                    });
                },
                onChange: function(){                     
                    window.location = this.items[0];
                }
        });

         $('#favourite-friend').selectize({
                
                selectOnTab : true,
                openOnFocus : false,
                closeAfterSelect : true,   
                maxItems: 6,          
                valueField: ['user_id'],
                labelField: ['firstname'], 
                searchField: ['firstname','lastname'], 
                maxOptions: 10,  
                options: [], 
                create: false,                      
                
                
                render: {   
                     option: function (data, escape) {
                        return '<div class="col-sm-6 col-md-4" style="height:190px;" >'+
                        '<a href="#" class="asdf">'+
                        '<div class="thumbnail"> <img src="'+ data.image_url +'" alt="image"  class="avatar_filter_black avatar_med"> '+
                        '<div class="caption" style="text-align:center;">'+
                        '<h5> '+escape(data.firstname)+' '+escape(data.lastname)+' </h5>'+
                        '<h6>@'+escape(data.user.username)+'</h6>'+                       
                        '</div>'+
                        '</div></a>'+
                        '</div>';   
                     }
                },
               
                load: function(query, callback) {
                    if (!query.length) return callback();                   
                   // var type= "All"; 
                    //if( $("#favourite-friend").hasClass('Friends')) type="Friends";         
                    $.ajax({
                        url: root+'/api/lookUp/Favourites',
                        type: 'GET',
                        dataType: 'json',
                        contentType: "application/json; charset=utf-8",
                        data: {
                            q: query
                        },
                        beforeSend: function(request) {                            
                            return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
                        },
                        error: function() {                          
                            callback();
                        },
                        success: function(res) { 
                               callback(res.data);
                        }
                    });
                },
                onChange: function(){    
                    var url =  root+'/api/addFavourite';
                    var dataString = 'id='+this.items[0];
                        $.ajax({
                                    type: 'POST',
                                    url: url,
                                    data: dataString,
                                    beforeSend: function(request) {
                                        $("#favourite-friend").attr("disabled", true);
                                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
                                    },
                                    success: function(response) {     
                                       alert(response);           
                                       $('.fav-modal').modal('hide')  ;
                                       $("#myFavFriends").load(location.href + " #myFavFriends");
                                    },
                                    error: function() {}
                                });

                    
                    console.log(this.items[0]);
                   // window.location = this.items[0];
                }
            });




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
 * Search a Friend
 */

$("#search_friend").submit(function(event) {
    event.preventDefault();
    var url = $(this).attr('action');
    var dataString = 'name=' + $(".fav1").val();
    
    if ($(".fav1").val() != "") {
        $.ajax({
            type: 'POST',
            url: url,
            data: dataString,
            beforeSend: function(request) {
                $(".search-friend-btn").attr("disabled", true);
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
            },
            success: function(response) {   
                alert(response);         
                $(".search-friend-btn").attr("disabled", false);
                $(".search-friend-btn").val("");
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

$("#sendFriendRequest").click(function(event){  

 var dataString = 'email=' + $("#userEmail").val();
  

 $.ajax({
            type: 'POST',
            url: root+'/sendFriendRequest',
            data: dataString,           
            beforeSend: function(request) {
                $("#sendFriendRequest").attr("disabled", true);
                return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
            },
            success: function(response) { 

                if(response == 1){
                     $("#AddFriendSpanButton").text("Friend Request Sent");                     
                     swal({   title: 'Done!',   text: 'Friend Request Sent',   timer: 1000 });
                } else {
                     $("#sendFriendRequest").attr("disabled", false);                     
                     swal(   'Error!',   response ,   'error' );
                }               
               
            },
            error: function() {}
        });

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

$(document).on("click", '.asdf',function(event){

    event.preventDefault();    
    event.stopPropagation(); 
    alert("ok");

});

$(document).on("click", '.respond-friend-request',function(event){

    event.preventDefault();    
    event.stopPropagation();   
    
    var url = $("#respondToFriendRequest").attr('action');    
    var id = $(this).attr('id');
    var arr = id.split('-');
    id = arr[1];
    var fid = arr[2];
    var response = arr[0]; 

    var dataString = 'id='+fid + '&response='+response;
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
                    $(".fa-users-freq").css("color", '#efefef');
                    $(".total-friend-requests").prepend('<div class="friend-requests-append">'
                        +'<li style="padding:5px;">No new requests</li>'
                        +'<li class="divider"> </li>' 
                        +' </div> ');
                  }               
               $(".freq").text(res);

               if(response == 0){                 
                   $("#1-"+id+'-'+fid).fadeOut(200);
                   $("#0-"+id+'-'+fid).attr("disabled",true);
                   $(".friend-request-"+id).fadeOut();
                   

                
               } else{ 
                   $("#0-"+id+'-'+fid).fadeOut(200);
                   $("#1-"+id+'-'+fid).attr("disabled",true);

                   // var count =  $('.count-total-friends-sidebar').val();  
                   // count += 1;                 
                   // $('.count-total-friends-sidebar').text(count);
                   // $('.total-friends-list-sidebar').prepend('<div class="my-friends-list-sidebar">'
                   //  +'<img src="'+imgsrc+'" class="avatar_tiny img-circle" alt="avatar">'
                   //  +'<a href="'+senderLink+'"> '+name+'  </a>'
                   // +' </div>');
               }
             
            },
            error: function() {}
        });


    // var total =  $(".total-friend-requests").children().length;
    


});

 $(function () {
    var items = $('#v-nav>ul>li').each(function () {
         $('#v-nav>div.tab-content').first().show();
        $(this).click(function () {
            //remove previous class and add it to clicked tab
          //  items.removeClass('active');
          //  $(this).addClass('active');

            //hide all content divs and show current one
            $('#v-nav>div.tab-content').hide().eq(items.index($(this))).show();

           // window.location.hash = $(this).attr('tab');
        });
    });

    if (location.hash) {
        showTab(location.hash);
    }
    else {
        showTab("tab1");
    }

     function showTab(tab) {
        $("#v-nav ul li[tab*=" + tab + "]").click();
        }

    
});



/**
 * Angular App
 * @type {[type]}
 */
// app = angular.module('pluto', []);
// app.config(['$interpolateProvider', function($interpolateProvider) {
//     $interpolateProvider.startSymbol('[[');
//     $interpolateProvider.endSymbol(']]');
// }]);
// app.controller('StatusController', ['$http', '$scope', function($http, $scope) {
//     $http.get('/status/user').success(function(result) {
//         $scope.statuses = result;
//     });
// }]);