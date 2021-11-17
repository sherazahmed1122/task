<?php
    header('Content-Type: application/javascript');
    ob_start();
    ob_end_clean();
?>
var base_url = "https://"+window.location.host+"/product_task/";

var app = angular.module('myApp', []);
var config = {
    headers: {
        'Content-Type': 'application/json;charset=utf-8;'
    }
};


app.controller("myController", function ($scope, $http, $window, $timeout) {
	$scope.formModel = {};
	$scope.pruducts = {};
	$scope.pruduct_detail = {};

	$scope.addProduct = function () {
		$('#tableContainer').css('display','none');
		$('#formContainer').css('display','block');
	};

	$scope.addNewProduct = function() {

		$http.post(base_url + 'task/add_product', $scope.formModel, config).then(
			function (response) {
				if(response.data.status == 'success'){
					$scope.fetchProductDetails();
					$('#tableContainer').css('display','block');
					$('#formContainer').css('display','none');
				}
            }, 
            function (error) {
                console.log(error.data);
        });

	};

	$scope.back = function (){
		$('#tableContainer').css('display','block');
		$('#formContainer').css('display','none');
		$('#formEditContainer').css('display','none');
	};

	$scope.fetchProductDetails = function(){
		$http.post(base_url + 'task/product_all_data', '', config).then(
			function (response) {
				$scope.products = response.data.data;
            }, 
            function (error) {
                console.log(error.data);
        });
	};

	$scope.editProduct = function(id){
		$http.post(base_url + 'task/edit_product', {id:id}, config).then(
			function (response) {
				$scope.formModel = response.data;
				$('#tableContainer').css('display','none');
				$('#formContainer').css('display','none');
				$('#formEditContainer').css('display','block');
            }, 
            function (error) {
                console.log(error.data);
        });
	};

	$scope.updateProduct = function(){
		$http.post(base_url + 'task/update_product', $scope.formModel, config).then(
			function (response) {
				$scope.fetchProductDetails();
				$('#tableContainer').css('display','block');
				$('#formContainer').css('display','none');
				$('#formEditContainer').css('display','none');
            }, 
            function (error) {
                console.log(error.data);
        });
	};

	$scope.deleteProduct = function(id){
		$http.post(base_url + 'task/deleteProduct', {id:id}, config).then(
			function (response) {
				$scope.fetchProductDetails();
				$('#tableContainer').css('display','block');
				$('#formContainer').css('display','none');
				$('#formEditContainer').css('display','none');
            }, 
            function (error) {
                console.log(error.data);
        });
	};
});
