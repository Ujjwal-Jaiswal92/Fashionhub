<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    die("Access Denied");
}

require_once "../../backend/controllers/ProductController.php";

$productController = new ProductController();
$products = $productController->getPendingProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Pending Products</title>

<style>

body{
    font-family:Arial;
    width:90%;
    margin:40px auto;
}

table{
    width:100%;
    border-collapse:collapse;
}

th,td{
    border:1px solid #ddd;
    padding:10px;
    text-align:center;
}

th{
    background:#000;
    color:#fff;
}

img{
    width:80px;
    height:80px;
    object-fit:cover;
}

a{
    text-decoration:none;
    padding:6px 10px;
    border-radius:5px;
}

.approve{
    background:green;
    color:white;
}

.reject{
    background:red;
    color:white;
}

</style>

</head>

<body>

<h1>Pending Product Approval</h1>

<table>

<tr>
    <th>ID</th>
    <th>Image</th>
    <th>Product</th>
    <th>Seller</th>
    <th>Category</th>
    <th>Price</th>
    <th>Stock</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php foreach($products as $product): ?>

<tr>

<td><?= $product['product_id']; ?></td>

<td>
<img src="../../uploads/products/<?= htmlspecialchars($product['image']); ?>">
</td>

<td><?= htmlspecialchars($product['product_name']); ?></td>

<td><?= htmlspecialchars($product['seller_name']); ?></td>

<td><?= htmlspecialchars($product['category_name']); ?></td>

<td>Rs. <?= $product['price']; ?></td>

<td><?= $product['stock']; ?></td>

<td><?= $product['status']; ?></td>

<td>

<a class="approve"
href="../../backend/api/products.php?action=approve&id=<?= $product['product_id']; ?>">
Approve
</a>

&nbsp;

<form
action="../../backend/api/products.php?action=reject"
method="POST"
style="display:inline;">

<input
type="hidden"
name="product_id"
value="<?= $product['product_id']; ?>">

<input
type="text"
name="reason"
placeholder="Reason"
required>

<button class="reject">
Reject
</button>

</form>

</td>

</tr>

<?php endforeach; ?>

</table>

</body>
</html>