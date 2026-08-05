<?php

require_once __DIR__ . '/../middleware/admin.php';

require_once "../controllers/CategoryController.php";

$category = new CategoryController();

$action = $_GET['action'] ?? '';

switch ($action) {

    case 'create':
        $category->create();
        break;

    case 'update':
        $category->update();
        break;

    case 'delete':
        $category->delete();
        break;

    default:
        echo "Invalid Action";
}
?>
