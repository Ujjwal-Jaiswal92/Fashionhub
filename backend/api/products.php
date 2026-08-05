<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../controllers/ProductController.php";

$product = new ProductController();

$action = $_GET['action'] ?? '';

switch ($action) {

    // Create Product
    case 'create':
        $product->createProduct();
        break;

    // Update Product
    case 'update':
        $product->updateProduct();
        break;

    // Delete Product
    case 'delete':
        $product->deleteProduct();
        break;

    // Approve Product
    case 'approve':
        $product->approveProduct();
        break;

    // Reject Product
    case 'reject':
        $product->rejectProduct();
        break;

    default:
        echo "Invalid Action";
        break;
}
?>