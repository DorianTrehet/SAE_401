<?php include("../www/header.inc.php"); ?>

<div class="container">
    <h1>Delete Brand</h1>
    <!-- Form for deleting brand -->
    <form id="deleteBrandForm" method="POST">
        <div class="form-group">
            <label for="brandSelect">Select Brand:</label>
            <select class="form-control" id="brandSelect" name="brandId" required>
                <!-- Options for brand selection will be inserted here -->
            </select>
        </div>
        <div class="form-group">
            <label for="apiKey">API Key:</label>
            <input type="text" class="form-control" id="apiKey" name="API_KEY" placeholder="Enter API Key" value="e8f1997c763" required>
        </div>
        <button type="submit" class="btn btn-danger">Delete Brand</button>
    </form>
</div>

<?php include("../www/footer.inc.php"); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // AJAX call to fetch brand data
    $.ajax({
        url: '/bikestores/brands',
        type: 'GET',
        success: function(response) {
            var brands = response;
            brands.forEach(function(brand) {
                $('#brandSelect').append('<option value="' + brand.brand_id + '">' + brand.brand_name + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });

    // Code JavaScript pour mettre à jour l'action du formulaire avec la valeur sélectionnée du menu déroulant
    $('#brandSelect').change(function() {
        var selectedBrandId = $(this).val();
        $('#deleteBrandForm').attr('action', '/bikestores/brands/delete/' + selectedBrandId);
    });

    // Submit form when submitted
    $('#deleteBrandForm').submit(function(e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            type: 'DELETE',
            data: formData,
            success: function(response) {
                alert("Brand successfully deleted");
                window.location.reload();
            },
            error: function(xhr, status, error) {
                alert("Error");
            }
        });
    });
});
</script>
