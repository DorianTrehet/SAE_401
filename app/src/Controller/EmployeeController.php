<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use App\Entity\Employees;
use App\Entity\Stores;
use Repository\EmployeeRepository;

/**
 * Class EmployeeController
 * @package App\Controller
 */
class EmployeeController
{
    /** @var \App\Repository\EmployeeRepository */
    private $employeeRepository;

    /** @var EntityManager */
    private $entityManager;

    const API_KEY = "e8f1997c763";

    /**
     * EmployeeController constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->employeeRepository = $entityManager->getRepository(Employees::class);
    }

    /**
     * Retrieve all employees
     */
    public function getAllEmployees()
    {
        $employees = $this->employeeRepository->findAll();
        header('Content-Type: application/json');
        echo json_encode($employees);
    }

    /**
     * Add a new employee
     */
    public function addEmployee()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['employee_name']) && isset($_POST['employee_email']) && isset($_POST['employee_password']) && isset($_POST['employee_role']) && isset($_POST['store_id'])) {

            if (!isset($_POST["API_KEY"]) || $_POST['API_KEY'] !== self::API_KEY) {
                echo json_encode(["error" => "Invalid API Key"]);
                return;
            }

            $storeId = $_POST['store_id'];
            $employeeName = $_POST['employee_name'];
            $employeeEmail = $_POST['employee_email'];
            $employeePassword = $_POST['employee_password'];
            $employeeRole = $_POST['employee_role'];

            // Retrieve the Stores instance corresponding to storeId
            $store = $this->entityManager->getRepository(Stores::class)->find($storeId);
            if (!$store) {
                echo json_encode(["error" => "Store not found"]);
                return;
            }

            $employee = new Employees();
            $employee->setStore($store); // Pass the Stores instance to setStore()
            $employee->setEmployeeName($employeeName);
            $employee->setEmployeeEmail($employeeEmail);
            $employee->setEmployeePassword($employeePassword);
            $employee->setEmployeeRole($employeeRole);

            $this->entityManager->persist($employee);
            $this->entityManager->flush();
            header('Content-Type: application/json');
            echo json_encode(['success' => 'Employee added successfully']);
        }
    }

    /**
     * Update an employee
     * @param array $params
     * @return mixed
     */
    public function updateEmployee($params)
    {
        $employeeId = $params['employeeId'];
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            parse_str(file_get_contents('php://input'), $_PUT);

            if (!isset($_PUT["API_KEY"]) || $_PUT['API_KEY'] !== self::API_KEY) {
                echo json_encode(["error" => "Invalid API Key"]);
                return;
            }

            $employee = $this->entityManager->getRepository(Employees::class)->find($employeeId);

            if (isset($_PUT['employee_name'])) {
                $employeeName = $_PUT['employee_name'];
                $employee->setEmployeeName($employeeName);
            }

            if (isset($_PUT['store_id'])) {
                $storeId = $_PUT['store_id'];
                $store = $this->entityManager->getRepository(Stores::class)->find($storeId);
                if (!$store) {
                    echo json_encode(["error" => "Store not found"]);
                    return;
                }
                $employee->setStore($store);
            }

            if (isset($_PUT['employee_email'])) {
                $employeeEmail = $_PUT['employee_email'];
                $employee->setEmployeeEmail($employeeEmail);
            }

            if (isset($_PUT['employee_password'])) {
                $employeePassword = $_PUT['employee_password'];
                $employee->setEmployeePassword($employeePassword);
            }

            if (isset($_PUT['employee_role'])) {
                $employeeRole = $_PUT['employee_role'];
                $employee->setEmployeeRole($employeeRole);
            }

            $this->entityManager->flush();

            echo json_encode(['success' => 'Employee updated']);
            return $employee;
        } else {
            echo json_encode(["error" => "invalid request"]);
        }
    }

    /**
     * Delete an employee
     * @param array $params
     */
    public function deleteEmployee($params)
    {
        $employeeId = $params['employeeId'];
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            parse_str(file_get_contents('php://input'), $_DELETE);

            if (!isset($_DELETE["API_KEY"]) || $_DELETE['API_KEY'] !== self::API_KEY) {
                echo json_encode(["error" => "Invalid API Key"]);
                return;
            }

            $employee = $this->entityManager->getRepository(Employees::class)->find($employeeId);

            if (!$employee) {
                echo json_encode(["error" => "Employee not found"]);
                return;
            }

            $this->entityManager->remove($employee);
            $this->entityManager->flush();

            echo json_encode(['success' => 'Employee deleted']);
        } else {
            echo json_encode(["error" => "invalid request"]);
            return;
        }
    }
/**
 * Handle login process
 */
public function login()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Fetch the employee from the database based on the provided email
        $employee = $this->employeeRepository->findOneBy(['employee_email' => $email]);

        if (!$employee) {
            // If no employee found with provided email, return an error response
            echo json_encode(["error" => "Invalid email"]);
            return;
        }

        $employeePwd = $employee->getEmployeePassword();

        if($employeePwd != $password){
            echo json_encode(["error" => "Invalid password"]);
            return;
        }

        // If email and password are correct, store user information in cookies
        setcookie('user_email', $email, time() + (86400 * 30), '/'); // 30 days expiration
        setcookie('user_name', $employee->getEmployeeName(), time() + (86400 * 30), '/');
        setcookie('user_role', $employee->getEmployeeRole(), time() + (86400 * 30), '/');

        // If email and password are correct, redirect the user to a different page upon successful login
        header('Location: app/src/View/EmployeeView.php');
        exit;
    }
}

/**
 * Handle logout process
 */
public function logout()
{
    // Supprimer tous les cookies en relation avec l'employé
    setcookie('user_email', '', time() - 3600, '/');
    setcookie('user_name', '', time() - 3600, '/');
    setcookie('user_role', '', time() - 3600, '/');

    // Rediriger l'utilisateur vers la page de connexion
    header('Location: app/src/View/indexView.php');
    exit;
}

    
}
