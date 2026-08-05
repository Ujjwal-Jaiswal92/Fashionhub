<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

session_start();

require_once "../controllers/OrderController.php";

$order = new OrderController();

$action = $_GET['action'] ?? '';

switch($action)
{
    case 'place':
        $order->placeOrder();
        break;
    case 'update-status':
        $order->updateOrderStatus();
        break;

    default:
        echo "Invalid Action";
}
