<?php
/**
 * Add New Stock Page
 *
 * This page allows users to add new stock to the system.
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
    <h1>Add New Stock</h1>
    <form action="/bikestores/stocks/create" method="POST">
        <div class="form-group">
            <label for="storeId">Store ID:</label>
            <input type="number" class="form-control" id="storeId" name="storeId" placeholder="Enter store ID" required>
        </div>
        <div class="form-group">
            <label for="productId">Product ID:</label>
            <input type="number" class="form-control" id="productId" name="productId" placeholder="Enter product ID" required>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter quantity" required>
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
