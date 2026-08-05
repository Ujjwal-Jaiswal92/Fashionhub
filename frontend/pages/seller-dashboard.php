<?php
session_start();

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'seller') {
    header("Location: login.php");
    exit();
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<section class="page-banner">
    <h1>Seller Dashboard</h1>
    <p>Welcome, <?= htmlspecialchars($_SESSION['full_name']) ?>. Add products and track their approval status.</p>
    <p><a class="btn-primary" href="seller-products.php">Manage My Products</a></p>
</section>
<?php include '../includes/footer.php'; ?>
