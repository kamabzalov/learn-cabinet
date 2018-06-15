var app = angular.module('products', ["ngRoute"]);
app.config(function($routeProvider, $locationProvider){
    $routeProvider
        .when("/:id", {
            templateUrl : "/views/product.tpl.php"
        })
     $locationProvider.html5Mode(true);
})

app.controller('productsController', function($scope, $http, $window) {

    $scope.getInfoByProductId = function(id) {
        $http({
            method: "GET",
            url: "http://cabinet.codetogether.ru/cabinet/products/getProduct",
            params: {id: id}
        }).then(function(result){
            $scope.productId = result.data.id;
            $scope.productName = result.data.name;
            $scope.productPrice = result.data.price;
        })
    }

    $scope.saveProduct = function() {
        $scope.productName = angular.element("#productName").val();
        $scope.productPrice = angular.element("#productPrice").val();

        $http({
            method: "POST",
            url: "http://cabinet.codetogether.ru/cabinet/products/saveProduct",
            data: $.param({id: $scope.productId, name: $scope.productName, price: $scope.productPrice}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(result){
            if(result.data.success) {
                $window.location.href = '/cabinet/products/';
            }
        })

    }

    $scope.addProduct = function() {
        $http({
            method: "POST",
            url: "http://cabinet.codetogether.ru/cabinet/products/addProduct",
            data: $.param({productName: $scope.newProductName, productPrice: $scope.newProductPrice}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(result){
            if(result.data.success) {
                $window.location.reload();
            }
        })

    }

    $scope.deleteProduct = function(id) {
        $http({
            method: "POST",
            url: "http://cabinet.codetogether.ru/cabinet/products/deleteProduct",
            data: $.param({id: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(result){
                $window.location.href = '/cabinet/products/';
        });
    }

});
