<?php include("../www/header.inc.php"); ?>

<div class="container">
    <h1>Delete Stock</h1>
    <!-- Form for deleting stock -->
    <form id="deleteStockForm" method="POST">
        <div class="form-group">
            <label for="stockSelect">Select Stock:</label>
            <select class="form-control" id="stockSelect" name="stockId" required>
                <!-- Options for stock selection will be inserted here -->
            </select>
        </div>
        <div class="form-group">
            <label for="apiKey">API Key:</label>
            <input type="text" class="form-control" id="apiKey" name="API_KEY" placeholder="Enter API Key" value="e8f1997c763" required>
        </div>
        <button type="submit" class="btn btn-danger">Delete Stock</button>
    </form>
</div>

<?php include("../www/footer.inc.php"); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // AJAX call to fetch stock data
    $.ajax({
        url: '/bikestores/stocks',
        type: 'GET',
        success: function(response) {
            var stocks = response;
            stocks.forEach(function(stock) {
                $('#stockSelect').append('<option value="' + stock.stock_id + '">' + stock.stock_id + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });

    // Code JavaScript pour mettre à jour l'action du formulaire avec la valeur sélectionnée du menu déroulant
    $('#stockSelect').change(function() {
        var selectedStockId = $(this).val();
        $('#deleteStockForm').attr('action', '/bikestores/stocks/delete/' + selectedStockId);
    });

    // Submit form when submitted
    $('#deleteStockForm').submit(function(e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            type: 'DELETE',
            data: formData,
            success: function(response) {
                alert("Stock successfully deleted");
                window.location.reload();
            },
            error: function(xhr, status, error) {
                alert("Error");
            }
        });
    });
});
</script>
