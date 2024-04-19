<?php include("../www/header.inc.php"); ?>

<div class="container">
    <h1>All Employees</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if(isset($_COOKIE['user_store'])) {
                $storeId = $_COOKIE['user_store'];

                $cookieName = 'employees_data';
                if(isset($_COOKIE[$cookieName])) {
                    $employeesData = json_decode($_COOKIE[$cookieName], true); // Décoder les données JSON

                    // Assurez-vous que $employeesData est un tableau associatif
                    if(is_array($employeesData)) {
                        foreach ($employeesData as $employee) {
            ?>
            <tr>
                <td><?php echo $employee['employee_id']; ?></td>
                <td><?php echo $employee['employee_name']; ?></td>
                <td><?php echo $employee['employee_email']; ?></td>
                <td><?php echo $employee['employee_role']; ?></td>
            </tr>
            <?php 
                        }
                    } else {
                        // Affiche un message si les données ne sont pas au format attendu
                        echo "<tr><td colspan='4'>Invalid employee data format.</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No employee data available for this store.</td></tr>";
                }
            } else {
                echo "<tr><td colspan='4'>User store ID not found in cookie.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include("../www/footer.inc.php"); ?>
