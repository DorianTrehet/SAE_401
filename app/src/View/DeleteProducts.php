<?php include("../www/header.inc.php"); ?>

<div class="container">
    <h1>Delete Product</h1>
    <!-- Form for deleting product -->
    <form id="deleteProductForm" method="POST">
        <div class="form-group">
            <label for="productSelect">Select Product:</label>
            <select class="form-control" id="productSelect" name="productId" required>
                <!-- Options for product selection will be inserted here -->
            </select>
        </div>
        <div class="form-group">
            <label for="apiKey">API Key:</label>
            <input type="text" class="form-control" id="apiKey" name="API_KEY" placeholder="Enter API Key" value="e8f1997c763" required>
        </div>
        <button type="submit" class="btn btn-danger">Delete Product</button>
    </form>
</div>

<?php include("../www/footer.inc.php"); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // AJAX call to fetch product data
    $.ajax({
        url: '/bikestores/products',
        type: 'GET',
        success: function(response) {
            var products = response;
            products.forEach(function(product) {
                $('#productSelect').append('<option value="' + product.product_id + '">' + product.product_name + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });

    // Code JavaScript pour mettre à jour l'action du formulaire avec la valeur sélectionnée du menu déroulant
    $('#productSelect').change(function() {
        var selectedProductId = $(this).val();
        $('#deleteProductForm').attr('action', '/bikestores/products/delete/' + selectedProductId);
    });

    // Submit form when submitted
    $('#deleteProductForm').submit(function(e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            type: 'DELETE',
            data: formData,
            success: function(response) {
                alert("Product successfully deleted");
                window.location.reload();
            },
            error: function(xhr, status, error) {
                alert("Error");
            }
        });
    });
});
</script>
