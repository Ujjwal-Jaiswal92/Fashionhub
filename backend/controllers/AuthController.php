<?php

require_once __DIR__ . '/../models/User.php';

class AuthController
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * Register User
     */
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            die("Invalid Request");
        }

        $full_name = trim($_POST['full_name']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $phone = trim($_POST['phone']);
        $address = trim($_POST['address']);
        $role = $_POST['role'];

        // Validation
        if (
            empty($full_name) ||
            empty($email) ||
            empty($password) ||
            empty($confirm_password) ||
            empty($role)
        ) {
            die("Please fill all required fields.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Invalid email address.");
        }

        if ($password !== $confirm_password) {
            die("Passwords do not match.");
        }

        if (strlen($password) < 6) {
            die("Password must be at least 6 characters.");
        }

        // Check Email
        if ($this->user->findByEmail($email)) {
            die("Email already exists.");
        }

        $data = [
            'full_name' => $full_name,
            'email' => $email,
            'password' => $password,
            'phone' => $phone,
            'address' => $address,
            'role' => $role
        ];

        if ($this->user->register($data)) {

            echo "Registration Successful.";

        } else {

            echo "Registration Failed.";

        }
    }

    /**
     * Login
     */
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            die("Invalid Request");
        }

        $email = trim($_POST['email']);
        $password = $_POST['password'];

        $user = $this->user->login($email, $password);

        if (!$user) {
            die("Invalid Email, Password or Account Not Approved.");
        }

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        switch ($user['role']) {

            case 'admin':
                header("Location: ../../frontend/admin/dashboard.php");
                break;

            case 'seller':
                header("Location: ../../frontend/pages/seller-dashboard.php");
                break;

            default:
                header("Location: ../../frontend/pages/index.php");
                break;
        }

        exit();
    }

    /**
     * Logout
     */
    public function logout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();

        header("Location: ../../frontend/pages/login.php");
        exit();
    }
}
?>