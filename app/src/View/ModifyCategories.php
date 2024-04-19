<?php
/**
 * Modify Category Page.
 *
 * This page allows users to modify a category's information.
 *
 * @category PHP
 * @package  BikeStores
 * @author   Dorian Trehet
 */

include("../www/header.inc.php");
?>
<div class="container">
    <h1>Modify Category</h1>
    <!-- Form for modifying category -->
    <form id="modifyCategoryForm" method="POST">
        <div class="form-group">
            <label for="categorySelect">Select Category:</label>
            <select class="form-control" id="categorySelect" name="categoryId" required>
                <!-- PHP loop to populate dropdown with category names and IDs -->
                <!-- The JavaScript code for fetching category names and IDs will be inserted here -->
            </select>
        </div>
        <div class="form-group">
            <label for="categoryName">New Category Name:</label>
            <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Enter new category name" required>
        </div>
        <div class="form-group">
            <label for="apiKey">API Key:</label>
            <input type="text" class="form-control" id="apiKey" name="API_KEY" placeholder="Enter API Key" value="e8f1997c763" required>
        </div>
        <button type="submit" class="btn btn-primary">Modify Category</button>
    </form>
</div>

<?php include("../www/footer.inc.php"); ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
/**
 * Executes when the document is ready.
 *
 * This function initializes the page and performs an AJAX request to fetch category data.
 * It also handles category selection change and form submission.
 *
 * @function
 * @name documentReady
 */
$(document).ready(function() {
    // AJAX call to fetch category data
    $.ajax({
        url: '/bikestores/categories', // URL for fetching categories
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
            var categories = response; // Category data
            // Use category data here
            // For example, you can populate them in the dropdown menu
            categories.forEach(function(category) {
                $('#categorySelect').append('<option value="' + category.category_id + '">' + category.category_name + '</option>');
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
    $('#categorySelect').change(function() {
        var selectedCategoryId = $(this).val();
        console.log(selectedCategoryId);
        $('#modifyCategoryForm').attr('action', '/bikestores/categories/update/' + selectedCategoryId);
    });

    // Submit the form using PUT method when it is submitted
    $('#modifyCategoryForm').submit(function(e) {
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
                alert("Category successfully modified");
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

