<?php include("../www/header.inc.php"); ?>

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
$(document).ready(function() {
    // Appel AJAX pour récupérer les données des produits
    $.ajax({
        url: '/bikestores/products', // URL de la route pour récupérer les produits
        type: 'GET',
        success: function(response) {
            // Succès de la requête
            var products = response; // Données des produits
            // Utiliser les données des produits ici
            // Par exemple, vous pouvez les afficher dans le menu déroulant
            products.forEach(function(product) {
                $('#productSelect').append('<option value="' + product.product_id + '">' + product.product_name + '</option>');
            });
        },
        error: function(xhr, status, error) {
            // Gérer les erreurs de la requête
            console.error(error);
        }
    });

    // Code JavaScript pour mettre à jour l'action du formulaire avec la valeur sélectionnée du menu déroulant
    $('#productSelect').change(function() {
        var selectedProductId = $(this).val();
        console.log(selectedProductId);
        $('#modifyProductForm').attr('action', '/bikestores/products/update/' + selectedProductId);
    });

    // Soumettre le formulaire en utilisant la méthode PUT lorsqu'il est envoyé
    $('#modifyProductForm').submit(function(e) {
        e.preventDefault(); // Empêche la soumission du formulaire par défaut

        var formData = $(this).serialize(); // Récupère les données du formulaire

        $.ajax({
            url: $(this).attr('action'),
            type: 'PUT',
            data: formData,
            success: function(response) {
                // Afficher un message de succès
                alert("Product successfully modified");
                // Recharger la page
                window.location.reload();
            },
            error: function(xhr, status, error) {
                alert("Error");
            }
        });
    });
});
</script>
