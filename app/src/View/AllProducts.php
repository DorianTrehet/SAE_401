<?php include("../www/header.inc.php"); ?>
<div class="container mt-5">
    <h1 class="mb-4">Product Catalog</h1>
    <div class="row">
        <!-- Sidebar with filters -->
        <div class="col-lg-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Filters</h5>
                    <!-- Filter options -->
                    <div class="form-group">
                        <label for="brandSelect">Brand:</label>
                        <select class="form-control" id="brandSelect">
                            <option value="">All Brands</option>
                            <!-- Option tags for each brand -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="categorySelect">Category:</label>
                        <select class="form-control" id="categorySelect">
                            <option value="">All Categories</option>
                            <!-- Option tags for each category -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="yearSelect">Year:</label>
                        <select class="form-control" id="yearSelect">
                            <option value="">All Years</option>
                            <!-- Option tags for each year -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="priceRange">Price Range:</label>
                        <!-- Price range slider -->
                        <input type="range" class="form-range" id="priceRange">
                    </div>
                    <!-- Button to apply filters -->
                    <button type="button" class="btn btn-primary btn-block">Apply Filters</button>
                </div>
            </div>
        </div>
        <!-- Product list -->
        <div class="col-lg-9">
            <div class="row" id="productList">
                <!-- Product cards will be dynamically inserted here -->
            </div>
        </div>
    </div>
</div>
<?php include("../www/footer.inc.php"); ?>

<script>
    $(document).ready(function() {
        // Fonction pour charger et afficher les produits
        function loadProducts() {
            $.ajax({
                url: '/bikestores/products', // Endpoint pour récupérer tous les produits
                type: 'GET',
                success: function(response) {
                    var products = response; // Données des produits
                    console.log(products);
                    var productList = $('#productList'); // Sélection de la liste des produits
                    
                    // Parcours des produits et création des cartes Bootstrap pour chaque produit
                    products.forEach(function(product) {
                        // Construction de la carte Bootstrap pour le produit
                        var cardHtml = '<div class="col-md-4 mb-4">';
                        cardHtml += '<div class="card">';
                        cardHtml += '<div class="card-body">';
                        cardHtml += '<strong><h4 class="card-title">' + product.product_name + '</h4></strong>';
                        cardHtml += '<p class="card-text">Year : ' + product.model_year + '</p>';
                        cardHtml += '<p class="card-text">Price: $' + product.list_price + '</p>';
                        cardHtml += '<strong><p class="card-text">Category : ' + product.category.category_name + '</p></strong>';
                        cardHtml += '</div></div></div>';
                        
                        // Ajout de la carte à la liste des produits
                        productList.append(cardHtml);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
        
        // Charger et afficher les produits lorsque la page est prête
        loadProducts();
    });
</script>
