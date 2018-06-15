$(document).ready(function(){

    $("#form-signin").submit(function(e) {
        e.preventDefault();

        var login = $.trim($("#login").val());
        var pass = $.trim($("#password").val());

        if(login == '' || pass == '') {
            $("img.profile-img").attr("src", "/images/user-error.png");
        } else {
            $("img.profile-img").attr("src", "/images/user-ok.png");
            $(this).unbind().submit();
        }
    });

});


var app = angular.module("mainPage", []);

app.controller("mainController", function($scope, $http){

    $scope.showEnterForm = true;

    $scope.createAccount = function() {
        $scope.showEnterForm = false;
        $scope.showRegForm = true;
    }

})
