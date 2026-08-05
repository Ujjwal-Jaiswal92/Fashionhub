<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Please login first.");
}

require_once "../../backend/controllers/CartController.php";

$cartController = new CartController();

$items = $cartController->getCartItems();

$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Shopping Cart</title>

<style>

body{
    font-family:Arial;
    width:90%;
    margin:40px auto;
    background:#f4f4f4;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

th,td{
    border:1px solid #ddd;
    padding:12px;
    text-align:center;
}

th{
    background:#111;
    color:white;
}

img{
    width:80px;
}

.checkout{
    margin-top:20px;
    text-align:right;
}

button{
    padding:12px 25px;
    background:#111;
    color:white;
    border:none;
    cursor:pointer;
}

</style>

</head>

<body>

<h1>My Cart</h1>

<table>

<tr>
    <th>Image</th>
    <th>Product</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Total</th>
</tr>

<?php foreach($items as $item): ?>

<?php
$subtotal = $item['price'] * $item['quantity'];
$total += $subtotal;
?>

<tr>

<td>

<img src="../../uploads/products/<?= htmlspecialchars($item['image']) ?>">

</td>

<td><?= htmlspecialchars($item['product_name']) ?></td>

<td>Rs. <?= number_format($item['price']) ?></td>

<td><?= $item['quantity'] ?></td>

<td>Rs. <?= number_format($subtotal) ?></td>

</tr>

<?php endforeach; ?>

</table>

<div class="checkout">

<h2>Total : Rs. <?= number_format($total) ?></h2>

<a href="checkout.php">

<button>

Proceed to Checkout

</button>

</a>

</div>

</body>
</html>