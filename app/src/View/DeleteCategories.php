<?php include("../www/header.inc.php"); ?>

<div class="container">
    <h1>Delete Category</h1>
    <!-- Form for deleting category -->
    <form id="deleteCategoryForm" method="POST">
        <div class="form-group">
            <label for="categorySelect">Select Category:</label>
            <select class="form-control" id="categorySelect" name="categoryId" required>
                <!-- Options for category selection will be inserted here -->
            </select>
        </div>
        <div class="form-group">
            <label for="apiKey">API Key:</label>
            <input type="text" class="form-control" id="apiKey" name="API_KEY" placeholder="Enter API Key" value="e8f1997c763" required>
        </div>
        <button type="submit" class="btn btn-danger">Delete Category</button>
    </form>
</div>

<?php include("../www/footer.inc.php"); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    // AJAX call to fetch category data
    $.ajax({
        url: '/bikestores/categories',
        type: 'GET',
        success: function(response) {
            var categories = response;
            categories.forEach(function(category) {
                $('#categorySelect').append('<option value="' + category.category_id + '">' + category.category_name + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });

    // Code JavaScript pour mettre à jour l'action du formulaire avec la valeur sélectionnée du menu déroulant
    $('#categorySelect').change(function() {
        var selectedCategoryId = $(this).val();
        $('#deleteCategoryForm').attr('action', '/bikestores/categories/delete/' + selectedCategoryId);
    });

    // Submit form when submitted
    $('#deleteCategoryForm').submit(function(e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            type: 'DELETE',
            data: formData,
            success: function(response) {
                alert("Category successfully deleted");
                window.location.reload();
            },
            error: function(xhr, status, error) {
                alert("Error");
            }
        });
    });
});
</script>
