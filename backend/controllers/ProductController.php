<?php

require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../helpers/upload.php';

class ProductController
{
    private $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    /*
    |--------------------------------------------------------------------------
    | Create Product
    |--------------------------------------------------------------------------
    */
    public function createProduct()
{
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        die("Invalid Request");
    }

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Upload Image
    $upload = uploadImage($_FILES['image']);

    if (!$upload['success']) {
        die($upload['message']);
    }

    $data = [
        'seller_id'    => $_SESSION['user_id'],
        'category_id'  => $_POST['category_id'],
        'product_name' => trim($_POST['product_name']),
        'description'  => trim($_POST['description']),
        'price'        => $_POST['price'],
        'stock'        => $_POST['stock'],
        'image'        => $upload['filename']
    ];

    if ($this->product->create($data)) {
        header("Location: ../../frontend/pages/seller-products.php?success=Product Added Successfully");
        exit();
    }

    die("Failed to Add Product");
}

    /*
    |--------------------------------------------------------------------------
    | View All Products (Admin)
    |--------------------------------------------------------------------------
    */
    public function getAllProducts()
    {
        return $this->product->getAll();
    }

    /*
    |--------------------------------------------------------------------------
    | View Approved Products (Customer)
    |--------------------------------------------------------------------------
    */
    public function getApprovedProducts()
{
    return $this->product->getApprovedProducts();
}
    /*
    |--------------------------------------------------------------------------
    | View Pending Products (Admin)
    |--------------------------------------------------------------------------
    */
    public function getPendingProducts()
    {
        return $this->product->getPending();
    }

    /*
    |--------------------------------------------------------------------------
    | Seller Products
    |--------------------------------------------------------------------------
    */
    public function getSellerProducts()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        return $this->product->getSellerProducts($_SESSION['user_id']);
    }

    /*
    |--------------------------------------------------------------------------
    | Get Single Product
    |--------------------------------------------------------------------------
    */
    public function getProduct($id)
    {
        return $this->product->getById($id);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Product
    |--------------------------------------------------------------------------
    */
    public function updateProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            die("Invalid Request");
        }

        $data = [
            'product_id'   => $_POST['product_id'],
            'category_id'  => $_POST['category_id'],
            'product_name' => trim($_POST['product_name']),
            'description'  => trim($_POST['description']),
            'price'        => $_POST['price'],
            'stock'        => $_POST['stock'],
            'image'        => $_POST['image']
        ];

        if ($this->product->update($data)) {
            header("Location: ../../frontend/pages/seller-products.php?success=Product Updated");
            exit();
        }

        die("Update Failed");
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Product
    |--------------------------------------------------------------------------
    */
    public function deleteProduct()
    {
        if (!isset($_GET['id'])) {
            die("Product ID Missing");
        }

        if ($this->product->delete($_GET['id'])) {
            header("Location: ../../frontend/pages/seller-products.php?success=Product Deleted");
            exit();
        }

        die("Delete Failed");
    }

    /*
    |--------------------------------------------------------------------------
    | Approve Product
    |--------------------------------------------------------------------------
    */
    public function approveProduct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $product_id = $_GET['id'];

        if ($this->product->approve($product_id, $_SESSION['user_id'])) {
            header("Location: ../../frontend/admin/products.php?success=Product Approved");
            exit();
        }

        die("Approval Failed");
    }

    /*
    |--------------------------------------------------------------------------
    | Reject Product
    |--------------------------------------------------------------------------
    */
    public function rejectProduct()
    {
        $product_id = $_POST['product_id'];
        $reason = trim($_POST['reason']);

        if ($this->product->reject($product_id, $reason)) {
            header("Location: ../../frontend/admin/products.php?success=Product Rejected");
            exit();
        }

        die("Rejection Failed");
    }
//     public function getPendingProducts()
// {
//     return $this->product->getPending();
// }

// public function getAllProducts()
// {
//     return $this->product->getAll();
// }

// public function getApprovedProducts()
// {
//     return $this->product->getApprovedProducts();
// }

public function getProductById($id)
{
    return $this->product->getById($id);
}
}
?>