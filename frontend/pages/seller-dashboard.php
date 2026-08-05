<?php
session_start();

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'seller') {
    header("Location: login.php");
    exit();
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<main class="seller-dashboard">
    <section class="seller-welcome">
        <span class="seller-eyebrow">FashionHub Seller Center</span>
        <h1>Welcome, <?= htmlspecialchars($_SESSION['full_name']) ?></h1>
        <p>List your fashion items, manage stock, and follow each product’s approval status in one place.</p>
        <div class="seller-actions">
            <a class="btn-primary" href="seller-products.php">Manage My Products</a>
            <a class="seller-shop-link" href="index.php">Go to Shop</a>
        </div>
    </section>
</main>
<?php include '../includes/footer.php'; ?>
