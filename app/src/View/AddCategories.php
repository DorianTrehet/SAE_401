<?php
/**
 * Add New Category Page
 *
 * This page allows users to add a new category to the system.
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
    <h1>Add New Category</h1>
    <form action="/bikestores/categories/create" method="POST">
        <div class="form-group">
            <label for="categoryName">Category Name:</label>
            <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Enter category name" required>
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
