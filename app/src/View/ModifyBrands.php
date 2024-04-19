<?php include("../www/header.inc.php"); ?>

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
$(document).ready(function() {
    // Appel AJAX pour récupérer les données des marques
    $.ajax({
        url: '/bikestores/brands', // URL de la route pour récupérer les marques
        type: 'GET',
        success: function(response) {
            // Succès de la requête
            var brands = response; // Données des marques
            // Utiliser les données des marques ici
            // Par exemple, vous pouvez les afficher dans le menu déroulant
            brands.forEach(function(brand) {
                $('#brandSelect').append('<option value="' + brand.brand_id + '">' + brand.brand_name + '</option>');
            });
        },
        error: function(xhr, status, error) {
            // Gérer les erreurs de la requête
            console.error(error);
        }
    });

    // Code JavaScript pour mettre à jour l'action du formulaire avec la valeur sélectionnée du menu déroulant
    $('#brandSelect').change(function() {
        var selectedBrandId = $(this).val();
        console.log(selectedBrandId);
        $('#modifyBrandForm').attr('action', '/bikestores/brands/update/' + selectedBrandId);
    });

    // Soumettre le formulaire en utilisant la méthode PUT lorsqu'il est envoyé
    $('#modifyBrandForm').submit(function(e) {
        e.preventDefault(); // Empêche la soumission du formulaire par défaut

        var formData = $(this).serialize(); // Récupère les données du formulaire

        $.ajax({
            url: $(this).attr('action'),
            type: 'PUT',
            data: formData,
            success: function(response) {
                // Afficher un message de succès
                alert("Brand successfully modified");
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
