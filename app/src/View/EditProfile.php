<?php
/**
 * Check if the employee ID exists in the cookie and retrieve it.
 * 
 * This section checks if the user ID cookie exists and retrieves the employee ID from it.
 *
 * PHP version 7.0
 *
 * @category PHP
 * @package  BikeStores
 * @author   Dorian Trehet
 */

if(isset($_COOKIE['user_id'])) {
    $employeeId = $_COOKIE['user_id'];

} else {
    echo "Employee ID not found in the cookie.";
}
?>

<?php include("../www/header.inc.php"); ?>

<div class="container">
    <h1>Edit Profile</h1>
    <form id="editProfileForm" action="/bikestores/employees/update/<?php echo $employeeId; ?>" method="POST">
        <div class="form-group">
            <label for="email">New Email:</label>
            <input type="email" class="form-control" id="employee_email" name="employee_email" placeholder="Enter your new email" required>
        </div>
        <div class="form-group">
            <label for="password">New Password:</label>
            <input type="password" class="form-control" id="employee_password" name="employee_password" placeholder="Enter your new password" required>
        </div>
        <div class="form-group">
            <label for="apiKey">API Key:</label>
            <input type="text" class="form-control" id="apiKey" name="API_KEY" placeholder="Enter API Key" value="e8f1997c763" required>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
/**
 * Function to submit the edit profile form via AJAX.
 */
$(document).ready(function() {
    // Submit form when submitted
    $('#editProfileForm').submit(function(e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            type: 'PUT',
            data: formData,
            success: function(response) {
                alert("Profile successfully updated");
            },
            error: function(xhr, status, error) {
                alert("Error");
            }
        });
    });
});
</script>

<?php include("../www/footer.inc.php"); ?>
