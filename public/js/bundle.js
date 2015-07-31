


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
                $(".avatar").attr('src', response + d.getTime());
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
                } else{
                    swal(   'Error!',   'Please Try again...',   'error' );
                }         
               
            },
            error: function() {}
        });
    }
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