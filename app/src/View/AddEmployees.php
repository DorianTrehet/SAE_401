<?php include("../www/header.inc.php"); ?>

<div class="container">
    <h1>Add New Employee</h1>
    <!-- Form for adding new employee -->
    <form id="addEmployeeForm" method="POST" action="/bikestores/employees/create">
        <div class="form-group">
            <label for="employeeName">Employee Name:</label>
            <input type="text" class="form-control" id="employeeName" name="employeeName" placeholder="Enter employee name" required>
        </div>
        <div class="form-group">
            <label for="employeeEmail">Employee Email:</label>
            <input type="email" class="form-control" id="employeeEmail" name="employeeEmail" placeholder="Enter employee email" required>
        </div>
        <div class="form-group">
            <label for="employeePassword">Employee Password:</label>
            <input type="password" class="form-control" id="employeePassword" name="employeePassword" placeholder="Enter employee password" required>
        </div>
        <div class="form-group">
            <label for="employeeRole">Employee Role:</label>
            <select class="form-control" id="employeeRole" name="employeeRole" required>
                <option value="employee">Employee</option>
                <option value="chief">Chief</option>
            </select>
        </div>
        <div class="form-group">
            <label for="storeSelect">Select Store:</label>
            <select class="form-control" id="storeSelect" name="storeId" required>
                <!-- PHP loop to populate dropdown with store names and IDs -->
                <!-- The JavaScript code for fetching store names and IDs will be inserted here -->
            </select>
        </div>
        <div class="form-group">
            <label for="apiKey">API Key:</label>
            <input type="text" class="form-control" id="apiKey" name="API_KEY" placeholder="Enter API Key" value="e8f1997c763" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Employee</button>
    </form>
</div>

<?php include("../www/footer.inc.php"); ?>

<script>
$(document).ready(function() {
    $.ajax({
        url: '/bikestores/stores', 
        type: 'GET',
        success: function(response) {
            var stores = response; 
            stores.forEach(function(store) {
                $('#storeSelect').append('<option value="' + store.store_id + '">' + store.store_name + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });

});
</script>
