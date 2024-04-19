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
            // Vérifier si les données des employés sont disponibles dans la session
            if(isset($_SESSION['all_employees_data'])) {
                // Récupérer les données JSON des employés depuis la session
                $jsonData = $_SESSION['all_employees_data'];

                // Convertir les données JSON en tableau associatif
                $employeesData = json_decode($jsonData, true);
                echo $employeesData;
                // Afficher les employés dans un tableau
                foreach ($employeesData as $employee) {
            ?>
            <tr>
                <td><?php echo $employee['employee_id']; ?></td>
                <td><?php echo $employee['employee_name']; ?></td>
                <td><?php echo $employee['employee_email']; ?></td>
                <td><?php echo $employee['employee_role']; ?></td>
            </tr>
            <?php 
                } // Fin de la boucle foreach
            } else {
                // Afficher un message si les données des employés ne sont pas disponibles
                echo "<tr><td colspan='4'>No employee data available.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include("../www/footer.inc.php"); ?>
