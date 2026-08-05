<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'seller') {
    die("Access Denied");
}

require_once "../../backend/controllers/ProductController.php";
require_once "../../backend/controllers/CategoryController.php";

$productController = new ProductController();
$categoryController = new CategoryController();

$products = $productController->getSellerProducts();
$categories = $categoryController->getAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Seller Products</title>

    <style>
        body{
            font-family: Arial;
            width:80%;
            margin:40px auto;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:30px;
        }

        th,td{
            border:1px solid #ddd;
            padding:10px;
        }

        th{
            background:#000;
            color:#fff;
        }

        input,textarea,select{
            width:100%;
            padding:10px;
            margin:8px 0;
        }

        button{
            padding:10px 20px;
            cursor:pointer;
        }

        img{
            width:70px;
        }
    </style>

</head>

<body>

<h1>Seller Product Management</h1>

<form
action="../../backend/api/products.php?action=create"
method="POST"
enctype="multipart/form-data">

<input
type="text"
name="product_name"
placeholder="Product Name"
required>

<textarea
name="description"
placeholder="Description"></textarea>

<select
name="category_id"
required>

<option value="">Select Category</option>

<?php foreach($categories as $category): ?>

<option value="<?= $category['category_id']; ?>">
<?= htmlspecialchars($category['category_name']); ?>
</option>

<?php endforeach; ?>

</select>

<input
type="number"
name="price"
placeholder="Price"
required>

<input
type="number"
name="stock"
placeholder="Stock"
required>

<input
type="file"
name="image"
required>

<button type="submit">
Add Product
</button>

</form>

<hr>

<h2>My Products</h2>

<table>

<tr>
<th>ID</th>
<th>Image</th>
<th>Name</th>
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

<?php if($product['image']) : ?>

<img
src="../../uploads/products/<?= htmlspecialchars($product['image']); ?>">

<?php endif; ?>

</td>

<td><?= htmlspecialchars($product['product_name']); ?></td>

<td><?= htmlspecialchars($product['category_name']); ?></td>

<td>Rs. <?= $product['price']; ?></td>

<td><?= $product['stock']; ?></td>

<td><?= $product['status']; ?></td>

<td>

<a
href="edit-product.php?id=<?= $product['product_id']; ?>">
Edit
</a>

|

<a
href="../../backend/api/products.php?action=delete&id=<?= $product['product_id']; ?>"
onclick="return confirm('Delete Product?')">
Delete
</a>

</td>

</tr>

<?php endforeach; ?>

</table>

</body>
</html>