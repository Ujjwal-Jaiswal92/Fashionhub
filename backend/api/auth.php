<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../controllers/AuthController.php";

$auth = new AuthController();

$action = $_GET['action'] ?? '';

switch ($action) {

    case 'register':
        $auth->register();
        break;

    case 'login':
        $auth->login();
        break;

    case 'logout':
        $auth->logout();
        break;

    case 'verify-email':
        $auth->verifyEmail();
        break;
    case 'request-reset':
        $auth->requestPasswordReset();
        break;
    case 'reset-password':
        $auth->resetPassword();
        break;

    default:
        echo "Invalid Action";
}
?>
