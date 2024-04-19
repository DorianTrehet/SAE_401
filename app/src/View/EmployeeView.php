<?php include("../www/header.inc.php"); ?>

<?php
/**
 * Retrieve cookies and check if the user is logged in.
 * 
 * This section retrieves cookies and checks if the user is logged in by verifying if the 'user_email' cookie exists.
 *
 * PHP version 7.0
 *
 * @category PHP
 * @package  BikeStores
 * @author   Dorian Trehet
 */

// Get all cookies
$cookies = getCookies();

// Check if the 'user_email' cookie exists
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
            <li>Edit your personal information</li>
        </ul>
    </div>
<?php   
} else {
    // Display an error message if no user is connected
    echo '<p>Error: No user connected.</p>';
}
?>

<?php include("../www/footer.inc.php"); ?>

<script>
/**
 * Function to retrieve all cookies in JavaScript.
 *
 * This function splits the document.cookie string into individual cookies and creates an object with cookie names as keys and cookie values as values.
 *
 * @returns {Object} An object containing all cookies.
 */
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

// Display all cookies in the console
console.log(getCookies());
</script>
