<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title></title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body ng-app="myApp">

	<div ng-controller="myController" ng-init="fetchProductDetails()">
		<div class="container" id="tableContainer">
			<button ng-click="addProduct()" class="btn btn-success">Add Product</button>
			<a href="https://localhost/product_task/task/ExportExcel/"><button class="btn btn-success pull-right">Export to Excel</button></a>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Title</th>
						<th>Description</th>
						<th>Price</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="product in products">
						<td>{{product.name}}</td>
						<td>{{product.description}}</td>
						<td>{{product.price}}</td>
						<td>
							<button class="btn btn-primary" ng-click="editProduct(product.id)">Edit</button>
							<button class="btn btn-danger" ng-click="deleteProduct(product.id)">Delete</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="container" id="formContainer" style="display: none;">
			<h3>Add New Product</h3>
			<form ng-submit="addNewProduct()">
				<input class="form-control" type="text" placeholder="Enter Title" ng-model="formModel.name"><br>
				<input class="form-control" type="text" placeholder="Enter Description" ng-model="formModel.description"><br>
				<input class="form-control" type="text" placeholder="Enter Price" ng-model="formModel.price"><br>
				<button type="submit" class="btn btn-success">Save</button>
				<button type="button" ng-click="back()" class="btn btn-primary">Back</button>
			</form>
		</div>

		<div class="container" id="formEditContainer" style="display: none;">
			<h3>Edit Product</h3>
			<form ng-submit="updateProduct()">
				<input class="form-control" type="text" placeholder="Enter Title" ng-model="formModel.name"><br>
				<input class="form-control" type="text" placeholder="Enter Description" ng-model="formModel.description"><br>
				<input class="form-control" type="text" placeholder="Enter Price" ng-model="formModel.price"><br>
				<button type="submit" class="btn btn-success">Update</button>
				<button type="button" ng-click="back()" class="btn btn-primary">Back</button>
			</form>
		</div>

	</div>

<script src="assets/angularjs/angular.min.js"></script>
<!-- App js -->
<script src="assets/js/app.php"></script>
</body>
</html>