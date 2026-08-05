<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once "../../backend/controllers/ProductController.php";


$productController = new ProductController();
$products = $productController->getApprovedProducts();
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<title>FashionHub</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial;
}

body{
    background:#f4f4f4;
}

header{
    background:#111;
    color:white;
    padding:20px;
}

header h1{
    text-align:center;
}

.container{
    width:90%;
    margin:30px auto;

    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(250px,1fr));
    gap:20px;
}

.card{

    background:white;

    border-radius:10px;

    overflow:hidden;

    box-shadow:0 0 10px rgba(0,0,0,.1);

}

.card img{

    width:100%;
    height:220px;

    object-fit:cover;

}

.card-body{

    padding:15px;

}

.card-body h3{

    margin-bottom:10px;

}

.price{

    color:green;
    font-size:20px;
    font-weight:bold;

    margin:10px 0;

}

button{

    width:100%;

    padding:12px;

    background:#111;

    color:white;

    border:none;

    cursor:pointer;

}

button:hover{

    background:#333;

}

</style>

</head>

<body>

<header>

<h1>FashionHub</h1>

</header>

<div class="container">

<?php foreach($products as $product): ?>

<div class="card">

<img src="../../uploads/products/<?= htmlspecialchars($product['image']) ?>">

<div class="card-body">

<h3><?= htmlspecialchars($product['product_name']) ?></h3>

<p>
Category :
<?= htmlspecialchars($product['category_name']) ?>
</p>

<p>
Seller :
<?= htmlspecialchars($product['seller_name']) ?>
</p>

<div class="price">

Rs.
<?= number_format($product['price']) ?>

</div>

<a href="product-details.php?id=<?= $product['product_id']; ?>">

<button>

View Details

</button>

</a>

</div>

</div>

<?php endforeach; ?>

</div>

</body>

</html>