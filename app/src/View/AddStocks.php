<?php include("../www/header.inc.php"); ?>

<div class="container">
    <h1>Add New Stock</h1>
    <form action="/bikestores/stocks/create" method="POST">
        <div class="form-group">
            <label for="stockQuantity">Stock Quantity:</label>
            <input type="number" class="form-control" id="stockQuantity" name="stockQuantity" placeholder="Enter stock quantity" required>
        </div>
        <div class="form-group">
            <label for="apiKey">API Key:</label>
            <input type="text" class="form-control" id="apiKey" name="API_KEY" placeholder="Enter API Key" value="e8f1997c763" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php include("../www/footer.inc.php"); ?>
