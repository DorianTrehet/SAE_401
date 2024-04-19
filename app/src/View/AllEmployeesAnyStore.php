<?php
/**
 * All Employees Page
 *
 * This page displays a table of all employees retrieved from the session.
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
            if(isset($_SESSION['all_employees_data'])) {
                $jsonData = $_SESSION['all_employees_data'];
                $employeesData = json_decode($jsonData, true);

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
                echo "<tr><td colspan='4'>No employee data available.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php
// Including footer file
include "../www/footer.inc.php";
?>
