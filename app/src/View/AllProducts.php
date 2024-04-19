<?php
/**
 * Product Catalog Page
 *
 * This page displays a product catalog with filtering options.
 *
 * PHP version 7.0
 *
 * @category PHP
 * @package  BikeStores
 * @author   Dorian Trehet
 */

// Including header file
include "../www/header.inc.php";
?>

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

<?php
// Including footer file
include "../www/footer.inc.php";
?>

<script>
/**
 * Load and display products.
 *
 * This function sends an AJAX request to fetch all products and dynamically
 * inserts them into the product list.
 */
$(document).ready(function() {
    function loadProducts() {
        $.ajax({
            url: '/bikestores/products', // Endpoint to retrieve all products
            type: 'GET',
            success: function(response) {
                var products = response; // Product data
                var productList = $('#productList'); // Selecting the product list

                // Iterate through products and create Bootstrap cards for each product
                products.forEach(function(product) {
                    // Constructing the Bootstrap card for the product
                    var cardHtml = '<div class="col-md-4 mb-4">';
                    cardHtml += '<div class="card">';
                    cardHtml += '<div class="card-body">';
                    cardHtml += '<strong><h4 class="card-title">' + product.product_name + '</h4></strong>';
                    cardHtml += '<p class="card-text">Year : ' + product.model_year + '</p>';
                    cardHtml += '<p class="card-text">Price: $' + product.list_price + '</p>';
                    cardHtml += '<strong><p class="card-text">Category : ' + product.category.category_name + '</p></strong>';
                    cardHtml += '</div></div></div>';

                    // Adding the card to the product list
                    productList.append(cardHtml);
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    // Load and display products when the page is ready
    loadProducts();
});
</script>
