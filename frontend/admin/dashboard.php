<?php
require_once '../../backend/middleware/admin.php';
require_once '../../backend/config/database.php';
$db = (new Database())->connect();
$productCount = (int)$db->query('SELECT COUNT(*) FROM products')->fetchColumn();
$orderCount = (int)$db->query('SELECT COUNT(*) FROM orders')->fetchColumn();
$userCount = (int)$db->query('SELECT COUNT(*) FROM users')->fetchColumn();
$revenue = (float)$db->query("SELECT COALESCE(SUM(total_amount), 0) FROM orders WHERE payment_status = 'Paid'")->fetchColumn();
$recentOrders = $db->query('SELECT o.order_id, o.total_amount, o.order_status, u.full_name FROM orders o JOIN users u ON u.user_id=o.user_id ORDER BY o.created_at DESC LIMIT 5')->fetchAll(PDO::FETCH_ASSOC);
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

            <li class="active"><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>

            <li><a href="products.php"><i class="fas fa-tshirt"></i> Products</a></li>

            <li><a href="categories.php"><i class="fas fa-list"></i> Categories</a></li>

            <li><a href="orders.php"><i class="fas fa-box"></i> Orders</a></li>

            <li><a href="users.php"><i class="fas fa-users"></i> Users</a></li>

            <li><a href="reports.php"><i class="fas fa-chart-line"></i> Reports</a></li>

            <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>

            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>

        </ul>

    </aside>

    <!-- Main -->

    <main class="main-content">

        <div class="topbar">

            <h1>Dashboard</h1>

            <div class="admin-user">

                <img src="../assets/images/users/user1.jpg">

                <span>Admin</span>

            </div>

        </div>

        <!-- Cards -->

        <div class="cards">

            <div class="card">

                <h3>Total Products</h3>

                <h2><?= $productCount ?></h2>

            </div>

            <div class="card">

                <h3>Total Orders</h3>

                <h2><?= $orderCount ?></h2>

            </div>

            <div class="card">

                <h3>Total Users</h3>

                <h2><?= $userCount ?></h2>

            </div>

            <div class="card">

                <h3>Revenue</h3>

                <h2>Rs. <?= number_format($revenue, 2) ?></h2>

            </div>

        </div>

        <!-- Recent Orders -->

        <div class="table-container">

            <h2>Recent Orders</h2>

            <table>

                <thead>

                    <tr>

                        <th>Order ID</th>

                        <th>Customer</th>

                        <th>Total</th>

                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>
                    <?php foreach ($recentOrders as $order): ?>
                    <tr><td>#<?= (int)$order['order_id'] ?></td><td><?= htmlspecialchars($order['full_name']) ?></td><td>Rs. <?= number_format((float)$order['total_amount'], 2) ?></td><td><span class="pending"><?= htmlspecialchars($order['order_status']) ?></span></td></tr>
                    <?php endforeach; ?>
                    <?php if (!$recentOrders): ?><tr><td colspan="4">No orders yet.</td></tr><?php endif; ?>
                    <?php if (false): ?>
                    <tr>

                        <td>#FH001</td>

                        <td>Srijana</td>

                        <td>Rs.2499</td>

                        <td><span class="success">Delivered</span></td>

                    </tr>

                    <tr>

                        <td>#FH002</td>

                        <td>Ram</td>

                        <td>Rs.3999</td>

                        <td><span class="pending">Pending</span></td>

                    </tr>

                    <tr>

                        <td>#FH003</td>

                        <td>Hari</td>

                        <td>Rs.1899</td>

                        <td><span class="processing">Processing</span></td>

                    </tr>

                    <?php endif; ?>
                </tbody>

            </table>

        </div>

    </main>

</div>
<?php include("../includes/admin-footer.php"); ?>
