<?php include("../www/header.inc.php"); ?>

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
        <li><a href="/bikestores/update/brands">Modify Brand</a></li>
        <li><a href="/bikestores/update/categories">Modify Category</a></li>
        <li><a href="/bikestores/update/products">Modify Product</a></li>
        <li><a href="/bikestores/update/stocks">Modify Stock</a></li>
    </ul>
    <h3>Delete</h3>
    <ul>
        <li><a href="/bikestores/delete/brands">Delete Brand</a></li>
        <li><a href="/bikestores/delete/categories">Delete Category</a></li>
        <li><a href="/bikestores/delete/products">Delete Product</a></li>
        <li><a href="/bikestores/delete/stocks">Delete Stock</a></li>
    </ul>
</div>

<?php include("../www/footer.inc.php"); ?>
