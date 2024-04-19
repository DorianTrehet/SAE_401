<?php
/**
 * Modify Brand Page.
 *
 * This page allows users to modify a brand's information.
 *
 * @category PHP
 * @package  BikeStores
 * @author   YourName
 */

include("../www/header.inc.php");
?>
<div class="container">
    <h1>Modify Brand</h1>
    <!-- Form for modifying brand -->
    <form id="modifyBrandForm" method="POST">
        <div class="form-group">
            <label for="brandSelect">Select Brand:</label>
            <select class="form-control" id="brandSelect" name="brandId" required>
                <!-- PHP loop to populate dropdown with brand names and IDs -->
                <!-- The JavaScript code for fetching brand names and IDs will be inserted here -->
            </select>
        </div>
        <div class="form-group">
            <label for="brandName">New Brand Name:</label>
            <input type="text" class="form-control" id="brandName" name="brandName" placeholder="Enter new brand name" required>
        </div>
        <div class="form-group">
            <label for="apiKey">API Key:</label>
            <input type="text" class="form-control" id="apiKey" name="API_KEY" placeholder="Enter API Key" value="e8f1997c763" required>
        </div>
        <button type="submit" class="btn btn-primary">Modify Brand</button>
    </form>
</div>

<?php include("../www/footer.inc.php"); ?>


<script>
/**
 * Executes when the document is ready.
 *
 * This function initializes the page and performs an AJAX request to fetch brand data.
 * It also handles brand selection change and form submission.
 *
 * @function
 * @name documentReady
 */
$(document).ready(function() {
    // AJAX call to fetch brand data
    $.ajax({
        url: '/bikestores/brands', // URL for fetching brands
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
            var brands = response; // Brand data
            // Use brand data here
            // For example, you can populate them in the dropdown menu
            brands.forEach(function(brand) {
                $('#brandSelect').append('<option value="' + brand.brand_id + '">' + brand.brand_name + '</option>');
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
    $('#brandSelect').change(function() {
        var selectedBrandId = $(this).val();
        console.log(selectedBrandId);
        $('#modifyBrandForm').attr('action', '/bikestores/brands/update/' + selectedBrandId);
    });

    // Submit the form using PUT method when it is submitted
    $('#modifyBrandForm').submit(function(e) {
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
                alert("Brand successfully modified");
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
