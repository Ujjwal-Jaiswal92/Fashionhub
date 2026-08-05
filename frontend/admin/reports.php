<?php
require_once '../../backend/middleware/admin.php';
require_once '../../backend/config/database.php';
$db = (new Database())->connect();
$reportRevenue = (float)$db->query("SELECT COALESCE(SUM(total_amount), 0) FROM orders WHERE payment_status = 'Paid'")->fetchColumn();
$reportOrders = (int)$db->query('SELECT COUNT(*) FROM orders')->fetchColumn();
$reportCustomers = (int)$db->query("SELECT COUNT(*) FROM users WHERE role IN ('customer', 'seller')")->fetchColumn();
$reportProductsSold = (int)$db->query('SELECT COALESCE(SUM(quantity), 0) FROM order_items')->fetchColumn();
$bestSellers = $db->query('SELECT p.product_name, c.category_name, SUM(oi.quantity) AS sold, SUM(oi.quantity * oi.price) AS revenue FROM order_items oi JOIN products p ON p.product_id = oi.product_id JOIN categories c ON c.category_id = p.category_id GROUP BY p.product_id, p.product_name, c.category_name ORDER BY sold DESC LIMIT 5')->fetchAll(PDO::FETCH_ASSOC);
include("../includes/header.php");
?>
<link rel="stylesheet" href="../assets/css/admin.css">

<div class="admin-container">

    <!-- Sidebar -->

    <aside class="sidebar">

        <div class="logo">
            <h2>FashionHub</h2>
            <p>Admin Panel</p>
        </div>

        <ul>

            <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="products.php"><i class="fas fa-tshirt"></i> Products</a></li>
            <li><a href="categories.php"><i class="fas fa-list"></i> Categories</a></li>
            <li><a href="orders.php"><i class="fas fa-box"></i> Orders</a></li>
            <li><a href="users.php"><i class="fas fa-users"></i> Users</a></li>
            <li class="active"><a href="reports.php"><i class="fas fa-chart-line"></i> Reports</a></li>
            <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
            <li><a href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>

        </ul>

    </aside>

    <!-- Main -->

    <main class="main-content">

        <div class="topbar">

            <h1>Sales Reports</h1>

        </div>

        <!-- Report Cards -->

        <div class="cards">

            <div class="card">

                <h3>Total Revenue</h3>

                <h2>Rs. <?= number_format($reportRevenue, 2) ?></h2>

            </div>

            <div class="card">

                <h3>Total Orders</h3>

                <h2><?= $reportOrders ?></h2>

            </div>

            <div class="card">

                <h3>Total Customers</h3>

                <h2><?= $reportCustomers ?></h2>

            </div>

            <div class="card">

                <h3>Products Sold</h3>

                <h2><?= $reportProductsSold ?></h2>

            </div>

        </div>

        <!-- Best Selling Products -->

        <div class="table-container">

            <h2>Best Selling Products</h2>

            <table>

                <thead>

                    <tr>

                        <th>Product</th>
                        <th>Category</th>
                        <th>Sold</th>
                        <th>Revenue</th>

                    </tr>

                </thead>

                <tbody>
                    <?php foreach ($bestSellers as $item): ?>
                    <tr><td><?= htmlspecialchars($item['product_name']) ?></td><td><?= htmlspecialchars($item['category_name']) ?></td><td><?= (int)$item['sold'] ?></td><td>Rs. <?= number_format((float)$item['revenue'], 2) ?></td></tr>
                    <?php endforeach; ?>
                    <?php if (!$bestSellers): ?><tr><td colspan="4">No completed sales yet.</td></tr><?php endif; ?>
                    <?php if (false): ?>
                    <tr>

                        <td>Classic Shirt</td>
                        <td>Men</td>
                        <td>135</td>
                        <td>Rs.337,365</td>

                    </tr>

                    <tr>

                        <td>Summer Dress</td>
                        <td>Women</td>
                        <td>112</td>
                        <td>Rs.313,488</td>

                    </tr>

                    <tr>

                        <td>Kids Jacket</td>
                        <td>Kids</td>
                        <td>86</td>
                        <td>Rs.180,600</td>

                    </tr>

                    <?php endif; ?>
                </tbody>

            </table>

        </div>

    </main>

</div>
<?php include("../includes/admin-footer.php"); ?>
