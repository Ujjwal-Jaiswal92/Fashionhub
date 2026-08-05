<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once "../../backend/controllers/ProductController.php";

$productController = new ProductController();

$id = $_GET['id'] ?? 0;

$product = $productController->getProductById($id);

if(!$product){
    die("Product not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<title><?= htmlspecialchars($product['product_name']) ?></title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial;
}

body{
    background:#f5f5f5;
}

.container{
    width:90%;
    max-width:1100px;
    margin:40px auto;
    display:flex;
    gap:40px;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,.1);
}

.image{
    flex:1;
}

.image img{
    width:100%;
    border-radius:10px;
}

.details{
    flex:1;
}

h1{
    margin-bottom:20px;
}

.price{
    color:green;
    font-size:30px;
    margin:20px 0;
    font-weight:bold;
}

button{
    width:100%;
    padding:15px;
    background:#111;
    color:white;
    border:none;
    cursor:pointer;
    font-size:16px;
}

button:hover{
    background:#333;
}

p{
    margin:12px 0;
}

</style>

</head>

<body>

<div class="container">

<div class="image">

<img src="../../uploads/products/<?= htmlspecialchars($product['image']) ?>">

</div>

<div class="details">

<h1><?= htmlspecialchars($product['product_name']) ?></h1>

<p>

<strong>Category:</strong>

<?= htmlspecialchars($product['category_name']) ?>

</p>

<p>

<strong>Seller:</strong>

<?= htmlspecialchars($product['seller_name']) ?>

</p>

<p>

<strong>Description:</strong>

<?= nl2br(htmlspecialchars($product['description'])) ?>

</p>

<p>

<strong>Available Stock:</strong>

<?= $product['stock'] ?>

</p>

<div class="price">

Rs. <?= number_format($product['price']) ?>

</div>

<form action="../../backend/api/cart.php?action=add" method="POST">

<input
type="hidden"
name="product_id"
value="<?= $product['product_id'] ?>">

<input
type="number"
name="quantity"
value="1"
min="1"
max="<?= $product['stock'] ?>"
style="width:100%;padding:12px;margin-bottom:20px;">

<button type="submit">

Add to Cart

</button>

</form>

</div>

</div>

</body>
</html>