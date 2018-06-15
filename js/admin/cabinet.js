var cabinet = angular.module('cabinet', []);

cabinet.controller("cabinetController", function($scope, $window, $http){

    $scope.openOrderDetails = function(orderId) {
        $window.location.href = "cabinet/orders?orderId=" + orderId;
    }

});