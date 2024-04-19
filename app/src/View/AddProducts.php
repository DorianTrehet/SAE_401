<?php
/**
 * Add New Product Page
 *
 * This page allows users to add a new product to the system.
 *
 * PHP version 7.0
 *
 * @category PHP
 * @package  BikeStores
 * @author   Dorian Trehet
 */

// Including header file
include "../www/header.inc.php";
?>

<div class="container">
    <h1>Add New Product</h1>
    <form action="/bikestores/products/create" method="POST">
        <div class="form-group">
            <label for="productName">Product Name:</label>
            <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter product name" required>
        </div>
        <div class="form-group">
            <label for="brandId">Brand ID:</label>
            <input type="number" class="form-control" id="brandId" name="brandId" placeholder="Enter brand ID" required>
        </div>
        <div class="form-group">
            <label for="categoryId">Category ID:</label>
            <input type="number" class="form-control" id="categoryId" name="categoryId" placeholder="Enter category ID" required>
        </div>
        <div class="form-group">
            <label for="modelYear">Model Year:</label>
            <input type="number" class="form-control" id="modelYear" name="modelYear" placeholder="Enter model year" required>
        </div>
        <div class="form-group">
            <label for="listPrice">Product Price:</label>
            <input type="number" class="form-control" id="productPrice" name="productPrice" step="0.10" placeholder="Enter list price" required>
        </div>
        <div class="form-group">
            <label for="apiKey">API Key:</label>
            <input type="text" class="form-control" id="apiKey" name="API_KEY" placeholder="Enter API Key" value="e8f1997c763" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php
// Including footer file
include "../www/footer.inc.php";
?>
