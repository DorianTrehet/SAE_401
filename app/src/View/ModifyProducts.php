<?php
/**
 * Modify Product Page.
 *
 * This page allows users to modify a product's information.
 *
 * @category PHP
 * @package  BikeStores
 * @author   Dorian Trehet
 */

include("../www/header.inc.php");
?>
<div class="container">
    <h1>Modify Product</h1>
    <!-- Form for modifying product -->
    <form id="modifyProductForm" method="POST">
        <div class="form-group">
            <label for="productSelect">Select Product:</label>
            <select class="form-control" id="productSelect" name="productId" required>
                <!-- PHP loop to populate dropdown with product names and IDs -->
                <!-- The JavaScript code for fetching product names and IDs will be inserted here -->
            </select>
        </div>
        <div class="form-group">
            <label for="productName">New Product Name:</label>
            <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter new product name" required>
        </div>
        <div class="form-group">
            <label for="modelYear">New Model Year:</label>
            <input type="number" class="form-control" id="modelYear" name="modelYear" placeholder="Enter new model year" required>
        </div>
        <div class="form-group">
            <label for="productPrice">New Product Price:</label>
            <input type="number" class="form-control" id="productPrice" name="productPrice" placeholder="Enter new product price" required>
        </div>
        <div class="form-group">
            <label for="apiKey">API Key:</label>
            <input type="text" class="form-control" id="apiKey" name="API_KEY" placeholder="Enter API Key" value="e8f1997c763" required>
        </div>
        <button type="submit" class="btn btn-primary">Modify Product</button>
    </form>
</div>

<?php include("../www/footer.inc.php"); ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
/**
 * Executes when the document is ready.
 *
 * This function initializes the page and performs an AJAX request to fetch product data.
 * It also handles product selection change and form submission.
 *
 * @function
 * @name documentReady
 */
$(document).ready(function() {
    // AJAX call to fetch product data
    $.ajax({
        url: '/bikestores/products', // URL for fetching products
        type: 'GET',
        /**
         * Success callback function for AJAX request.
         *
         * @callback
         * @name ajaxSuccess
         * @param {Object[]} response - Response data from AJAX request.
         */
        success: function(response) {
            // Successful request
            var products = response; // Product data
            // Use product data here
            // For example, you can populate them in the dropdown menu
            products.forEach(function(product) {
                $('#productSelect').append('<option value="' + product.product_id + '">' + product.product_name + '</option>');
            });
        },
        /**
         * Error callback function for AJAX request.
         *
         * @callback
         * @name ajaxError
         * @param {Object} xhr - XMLHttpRequest object representing the AJAX request.
         * @param {string} status - Request status.
         * @param {string} error - Error message.
         */
        error: function(xhr, status, error) {
            // Handle request errors
            console.error(error);
        }
    });

    // JavaScript code to update form action with selected dropdown value
    $('#productSelect').change(function() {
        var selectedProductId = $(this).val();
        console.log(selectedProductId);
        $('#modifyProductForm').attr('action', '/bikestores/products/update/' + selectedProductId);
    });

    // Submit the form using PUT method when it is submitted
    $('#modifyProductForm').submit(function(e) {
        e.preventDefault(); // Prevent default form submission

        var formData = $(this).serialize(); // Get form data

        $.ajax({
            url: $(this).attr('action'),
            type: 'PUT',
            data: formData,
            /**
             * Success callback function for form submission AJAX request.
             *
             * @callback
             * @name formSubmitSuccess
             * @param {Object} response - AJAX request response.
             */
            success: function(response) {
                // Show success message
                alert("Product successfully modified");
                // Reload the page
                window.location.reload();
            },
            /**
             * Error callback function for form submission AJAX request.
             *
             * @callback
             * @name formSubmitError
             * @param {Object} xhr - XMLHttpRequest object representing the AJAX request.
             * @param {string} status - Request status.
             * @param {string} error - Error message.
             */
            error: function(xhr, status, error) {
                alert("Error");
            }
        });
    });
});
</script>

