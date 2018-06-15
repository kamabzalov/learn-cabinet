var order = angular.module("order", []);

order.controller("orderController", function($scope, $http, $window){

    $scope.checkOrder = function(id) {
        $http({
            method: "POST",
            url: "http://cabinet.codetogether.ru/cabinet/orders/checkOrder",
            data: $.param({id: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(result){
            alert(result.data.text);
            $window.location.href = '/cabinet';
        })
    }

    $scope.deleteOrder = function(id) {
        $http({
            method: "POST",
            url: "http://cabinet.codetogether.ru/cabinet/orders/deleteOrder",
            data: $.param({id: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(result){
            alert(result.data.text);
            $window.location.href = '/cabinet';
        })
    }

});