<?php
/**
 * Modify Stock Page.
 *
 * This page allows users to modify stock information.
 *
 * @category PHP
 * @package  BikeStores
 * @author   Dorian Trehet
 */

include("../www/header.inc.php");
?>
<div class="container">
    <h1>Modify Stock</h1>
    <!-- Form for modifying stock -->
    <form id="modifyStockForm" method="POST">
        <div class="form-group">
            <label for="stockSelect">Select Stock:</label>
            <select class="form-control" id="stockSelect" name="stockId" required>
                <!-- Options for stock selection will be inserted here -->
            </select>
        </div>
        <div class="form-group">
            <label for="quantity">New Quantity:</label>
            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter new quantity" required>
        </div>
        <div class="form-group">
            <label for="apiKey">API Key:</label>
            <input type="text" class="form-control" id="apiKey" name="API_KEY" placeholder="Enter API Key" value="e8f1997c763" required>
        </div>
        <button type="submit" class="btn btn-primary">Modify Stock</button>
    </form>
</div>

<?php include("../www/footer.inc.php"); ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
/**
 * Executes when the document is ready.
 *
 * This function initializes the page and performs an AJAX request to fetch stock data.
 * It also handles stock selection change and form submission.
 *
 * @function
 * @name documentReady
 */
$(document).ready(function() {
    // AJAX call to fetch stock data
    $.ajax({
        url: '/bikestores/stocks',
        type: 'GET',
        /**
         * Success callback function for AJAX request.
         *
         * @callback
         * @name ajaxSuccess
         * @param {Object[]} response - Response data from AJAX request.
         */
        success: function(response) {
            var stocks = response;
            stocks.forEach(function(stock) {
                $('#stockSelect').append('<option value="' + stock.stock_id + '">' + stock.stock_id + '</option>');
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
            console.error(error);
        }
    });

    // Update form action with selected stock ID
    $('#stockSelect').change(function() {
        var selectedStockId = $(this).val();
        $('#modifyStockForm').attr('action', '/bikestores/stocks/update/' + selectedStockId);
    });

    // Submit form using PUT method when submitted
    $('#modifyStockForm').submit(function(e) {
        e.preventDefault();

        var formData = $(this).serialize();

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
                alert("Stock successfully modified");
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

