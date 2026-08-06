<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

session_start();

require_once "../controllers/OrderController.php";

$order = new OrderController();

$action = $_GET['action'] ?? '';

// Compatibility for payments started before the dedicated eSewa callback was
// added. eSewa appends ?data=... after the existing action query parameter.
if (str_starts_with($action, 'esewa-return?data=')) {
    $rawQuery = $_SERVER['QUERY_STRING'] ?? '';
    $prefix = 'action=esewa-return?data=';
    $position = strpos($rawQuery, $prefix);
    $_GET['data'] = $position === false
        ? substr($action, strlen('esewa-return?data='))
        : rawurldecode(substr($rawQuery, $position + strlen($prefix)));
    $action = 'esewa-return';
}

switch($action)
{
    case 'place':
        $order->placeOrder();
        break;
    case 'update-status':
        $order->updateOrderStatus();
        break;
    case 'esewa-return':
        $order->esewaReturn();
        break;

    default:
        echo "Invalid Action";
}
