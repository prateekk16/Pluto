$("#postStatus").submit(function(e) {
    e.preventDefault();
    $("#postStatusBtn").attr("disabled", true);
    var url = $(this).attr('action');
    var dataString = 'body=' + $(".status-body").val();
    $.ajax({
        type: 'POST',
        url: url,
        data: dataString,
        beforeSend: function(request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
        },
        success: function(response) {
            $("<p>" + response['body'] + "</p>").prependTo(".media");
            $("#postStatusBtn").attr("disabled", false);
            $(".status-body").val("");
        },
        error: function() {}
    });
});


$('#uploadAvatar').on('submit', (function(e) {
    var url = $(this).attr('action');
   
    e.preventDefault();
    $("#uploadAvatar-btn").attr("disabled", true);
    $(".uploadAvatar-btn-text").text("Please wait...");
    var data = new FormData(this);
    
     $.ajax({
                                                        type:'POST',
                                                        url: url,
                                                        data: data,
                                                          beforeSend: function(request) {
            return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
        },
                                                        success:function(response){                                                               

                                                            swal( 'Done!', 'success'   );
                                                            $("#uploadAvatar-btn").attr("disabled", false);
                                                            $(".uploadAvatar-btn-text").text("Upload");
                                                            $(.change-dp-modal).modal(hide);
                                                        },
                                                        error:function(){

                                                        }                                                        
            });
    
}));





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