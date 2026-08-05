<?php
require_once '../../backend/controllers/ProductController.php';
$productId = (int)($_GET['id'] ?? 0);
$product = $productId ? (new ProductController())->getProductById($productId) : false;
if (!$product || $product['status'] !== 'Approved') { http_response_code(404); include '404.php'; exit; }
include("../includes/header.php");
?>
<?php include("../includes/navbar.php"); ?>

<!-- ================= PRODUCT DETAILS ================= -->

<section class="product-details">

    <!-- Left Side -->

    <div class="product-gallery">

        <img src="../../uploads/products/<?= htmlspecialchars($product['image'] ?: 'placeholder.png') ?>" class="main-image" alt="<?= htmlspecialchars($product['product_name']) ?>">

        <div class="thumbnail-images">

            <img src="../../uploads/products/<?= htmlspecialchars($product['image'] ?: 'placeholder.png') ?>" alt="<?= htmlspecialchars($product['product_name']) ?>">

        </div>

    </div>

    <!-- Right Side -->

    <div class="product-info-details">

        <span class="product-category">
            <?= htmlspecialchars($product['category_name']) ?>
        </span>

        <h1>
            <?= htmlspecialchars($product['product_name']) ?>
        </h1>

        <div class="rating">
            Sold by <?= htmlspecialchars($product['seller_name']) ?>
        </div>

        <div class="product-price">

            Rs. <?= number_format((float)$product['price'], 2) ?>

        </div>

        <p>

            <?= nl2br(htmlspecialchars($product['description'])) ?>

        </p>

        <p>Available stock: <?= (int)$product['stock'] ?></p>
        <form action="../../backend/api/cart.php?action=add" method="POST">
            <input type="hidden" name="product_id" value="<?= (int)$product['product_id'] ?>">
            <h3>Quantity</h3>
            <input type="number" name="quantity" value="1" min="1" max="<?= (int)$product['stock'] ?>" required>
            <div class="product-buttons">
                <button class="cart-btn" type="submit" <?= $product['stock'] < 1 ? 'disabled' : '' ?>>Add to Cart</button>
            </div>
        </form>

    </div>

</section>

<?php include("../includes/footer.php"); ?>
