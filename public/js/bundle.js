



$("#postStatus").submit(function(e){
    
    
    e.preventDefault();

    $("#postStatusBtn").attr("disabled", true);    
    var url = $(this).attr('action');  
    var dataString = 'body='+$(".status-body").val();
    

    $.ajax({
        type: 'POST',
        url: url,
        data: dataString,
        beforeSend: function (request) {
                       return request.setRequestHeader('X-CSRF-Token', $("meta[name='_token']").attr('content'));
                       
                    },
        success: function(response) {           
           
            $("<p>"+response['body']+"</p>").appendTo(".posts");
            $("#postStatusBtn").attr("disabled", false);         
            
        },
        error: function() {}
    });
});





app = angular.module('pluto', []);

app.config(['$interpolateProvider', function ($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
}]);

app.controller('StatusController', ['$http', '$scope', function($http, $scope) {

   // $scope.statuses = [
   //      { body: 'Go to store', completed:true },
   //      { body: 'Finish video', completed:false },
   //       { body: 'Learn Angular', completed:false }  
   //  ];

    $http.get('/status/user').success(function(result){
        alert(result);
        $scope.statuses = result;
    });


  }]);