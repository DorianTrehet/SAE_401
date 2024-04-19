<?php include("../www/header.inc.php"); ?>

<?php
// // Fonction pour récupérer tous les cookies
// function getCookies() {
//     $cookies = $_COOKIE;
//     return $cookies;
// }

// Récupérer les cookies
$cookies = getCookies();

// Vérifier si l'email de l'utilisateur est défini dans les cookies
if (isset($cookies['user_email'])) {
?>
    <div class="container">
        <h1>Welcome, <?php echo $_COOKIE['user_name']; ?>!</h1>
        <p>You have employee privileges.</p>
        <p>Here are your additional functionalities:</p>
        <ul>
            <li>Add new brands/categories/products/stocks</li>
            <li>Modify brands/categories/products/stocks</li>
            <li>Delete brands/categories/products/stocks</li>
            <li>Edit your personnal information</li>
        </ul>
    </div>
<?php   
} else {
    // If the user's email is not defined in the cookies, display an error message
    echo '<p>Error: No user connected.</p>';

}
?>

<?php include("../www/footer.inc.php"); ?>

<script>
// Fonction pour récupérer tous les cookies en JavaScript
function getCookies() {
    var cookies = document.cookie.split(';');
    var cookiesObject = {};
    cookies.forEach(function(cookie) {
        var parts = cookie.split('=');
        var name = parts.shift().trim();
        var value = decodeURIComponent(parts.join('='));
        cookiesObject[name] = value;
    });
    return cookiesObject;
}

// Afficher tous les cookies dans la console
console.log(getCookies());
</script>