<?php
/**
 * Add/Modify/Delete Page.
 *
 * This page provides links to add, modify, and delete operations for brands, categories, products, and stocks.
 *
 * @category PHP
 * @package  BikeStores
 * @author   Dorian Trehet
 */

include("../www/header.inc.php");
?>
<!-- Add view content -->
<div class="container">
    <h1>Add/Modify/Delete</h1>
    <h3>Add New:</h3>
    <ul>
        <li><a href="/bikestores/app/src/View/AddBrands.php">Add Brand</a></li>
        <li><a href="/bikestores/app/src/View/AddCategories.php">Add Category</a></li>
        <li><a href="/bikestores/app/src/View/AddProducts.php">Add Product</a></li>
        <li><a href="/bikestores/app/src/View/AddStocks.php">Add Stock</a></li>
    </ul>
    <h3>Modify</h3>
    <ul>
        <li><a href="/bikestores/app/src/View/ModifyBrands.php">Modify Brand</a></li>
        <li><a href="/bikestores/app/src/View/ModifyCategories.php">Modify Category</a></li>
        <li><a href="/bikestores/app/src/View/ModifyProducts.php">Modify Product</a></li>
        <li><a href="/bikestores/app/src/View/ModifyStocks.php">Modify Stock</a></li>
    </ul>
    <h3>Delete</h3>
    <ul>
        <li><a href="/bikestores/app/src/View/DeleteBrands.php">Delete Brand</a></li>
        <li><a href="/bikestores/app/src/View/DeleteCategories.php">Delete Category</a></li>
        <li><a href="/bikestores/app/src/View/DeleteProducts.php">Delete Product</a></li>
        <li><a href="/bikestores/app/src/View/DeleteStocks.php">Delete Stock</a></li>
    </ul>
</div>

<?php include("../www/footer.inc.php"); ?>
