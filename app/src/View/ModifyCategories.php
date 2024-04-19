<?php include("../www/header.inc.php"); ?>

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
$(document).ready(function() {
    // Appel AJAX pour récupérer les données des catégories
    $.ajax({
        url: '/bikestores/categories', // URL de la route pour récupérer les catégories
        type: 'GET',
        success: function(response) {
            // Succès de la requête
            var categories = response; // Données des catégories
            // Utiliser les données des catégories ici
            // Par exemple, vous pouvez les afficher dans le menu déroulant
            categories.forEach(function(category) {
                $('#categorySelect').append('<option value="' + category.category_id + '">' + category.category_name + '</option>');
            });
        },
        error: function(xhr, status, error) {
            // Gérer les erreurs de la requête
            console.error(error);
        }
    });

    // Code JavaScript pour mettre à jour l'action du formulaire avec la valeur sélectionnée du menu déroulant
    $('#categorySelect').change(function() {
        var selectedCategoryId = $(this).val();
        console.log(selectedCategoryId);
        $('#modifyCategoryForm').attr('action', '/bikestores/categories/update/' + selectedCategoryId);
    });

    // Soumettre le formulaire en utilisant la méthode PUT lorsqu'il est envoyé
    $('#modifyCategoryForm').submit(function(e) {
        e.preventDefault(); // Empêche la soumission du formulaire par défaut

        var formData = $(this).serialize(); // Récupère les données du formulaire

        $.ajax({
            url: $(this).attr('action'),
            type: 'PUT',
            data: formData,
            success: function(response) {
                // Afficher un message de succès
                alert("Category successfully modified");
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
