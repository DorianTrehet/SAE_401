<?php include("../www/header.inc.php"); ?>
<div class="container-fluid bg-dark text-light p-5">
    <div class="container">
        <h1 class="display-4">BikeStore</h1>
        <p class="lead">Your one-stop shop for all your biking needs!</p>
        <p>At BikeStore, we're passionate about biking. Whether you're a casual rider or a hardcore enthusiast, we've got everything you need to hit the road or trail. From bikes and accessories to expert advice, our friendly staff are here to help you make the most of your biking experience.</p>
    </div>
</div>
<div class="container mt-4">
    <div id="map" style="height: 500px;"></div>
</div>
<!-- Fichiers Javascript -->
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
<script type="text/javascript">
    // On initialise la latitude et la longitude de Paris (centre de la carte)
    var lat = 36.963343;
    var lon = -121.968305;
    var macarte = null;
    // Fonction d'initialisation de la carte
    function initMap() {
        // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
        macarte = L.map('map', {
            zoomControl: false // Désactiver les boutons de zoom avant et arrière
        }).setView([lat, lon], 3); // Zoom plus large pour afficher les marqueurs
        // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
        L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
            // Il est toujours bien de laisser le lien vers la source des données
            attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
            minZoom: 1,
            maxZoom: 20
        }).addTo(macarte);

        // Ajouter les marqueurs pour les magasins
        var stores = [
            { name: 'Store 1', lat: 36.963343, lon: -121.968305 },
            { name: 'Store 2', lat: 43.0014907, lon: -83.5826126 },
            { name: 'Store 3', lat: 33.04788, lon: -97.08963 }
        ];

        stores.forEach(function(store) {
            L.marker([store.lat, store.lon]).addTo(macarte)
                .bindPopup(store.name);
        });
    }
    window.onload = function() {
        // Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
        initMap();
    };
</script>
<?php include("../www/footer.inc.php"); ?>
