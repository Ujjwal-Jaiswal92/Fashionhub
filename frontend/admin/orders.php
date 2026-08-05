<?php
require_once '../../backend/middleware/admin.php';
require_once '../../backend/config/database.php';
$db = (new Database())->connect();
$orders = $db->query('SELECT o.*, u.full_name FROM orders o JOIN users u ON u.user_id=o.user_id ORDER BY o.created_at DESC')->fetchAll(PDO::FETCH_ASSOC);
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
            <li class="active"><a href="orders.php"><i class="fas fa-box"></i> Orders</a></li>
            <li><a href="users.php"><i class="fas fa-users"></i> Users</a></li>
            <li><a href="reports.php"><i class="fas fa-chart-line"></i> Reports</a></li>
            <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>

        </ul>

    </aside>

    <!-- Main -->

    <main class="main-content">

        <div class="topbar">

            <h1>Orders</h1>

        </div>

        <div class="table-container">

            <table>

                <thead>

                    <tr>

                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>
                    <?php foreach ($orders as $order): ?>
                    <tr><td>#<?= (int)$order['order_id'] ?></td><td><?= htmlspecialchars($order['full_name']) ?></td><td><?= htmlspecialchars($order['created_at']) ?></td><td>Rs. <?= number_format((float)$order['total_amount'], 2) ?></td><td><?= htmlspecialchars($order['payment_method']) ?><br><small><?= htmlspecialchars($order['payment_status']) ?></small></td><td><span class="status pending"><?= htmlspecialchars($order['order_status']) ?></span></td><td><form action="../../backend/api/orders.php?action=update-status" method="POST"><input type="hidden" name="order_id" value="<?= (int)$order['order_id'] ?>"><select name="order_status"><?php foreach (['Pending','Processing','Shipped','Delivered','Cancelled'] as $status): ?><option <?= $order['order_status'] === $status ? 'selected' : '' ?>><?= $status ?></option><?php endforeach; ?></select><select name="payment_status"><?php foreach (['Pending','Paid','Failed'] as $status): ?><option <?= $order['payment_status'] === $status ? 'selected' : '' ?>><?= $status ?></option><?php endforeach; ?></select><button class="edit-btn" type="submit">Update</button></form></td></tr>
                    <?php endforeach; ?>
                    <?php if (!$orders): ?><tr><td colspan="7">No orders yet.</td></tr><?php endif; ?>
                    <?php if (false): ?>
                    <tr>

                        <td>#FH1001</td>
                        <td>Srijana Uranw</td>
                        <td>04 Aug 2026</td>
                        <td>Rs.2,499</td>
                        <td>COD</td>

                        <td>

                            <span class="status delivered">

                                Delivered

                            </span>

                        </td>

                        <td>

                            <a href="#" class="view-btn">View</a>

                        </td>

                    </tr>

                    <tr>

                        <td>#FH1002</td>
                        <td>Ram Sharma</td>
                        <td>03 Aug 2026</td>
                        <td>Rs.3,299</td>
                        <td>eSewa</td>

                        <td>

                            <span class="status pending">

                                Pending

                            </span>

                        </td>

                        <td>

                            <a href="#" class="view-btn">View</a>

                        </td>

                    </tr>

                    <tr>

                        <td>#FH1003</td>
                        <td>Sita KC</td>
                        <td>02 Aug 2026</td>
                        <td>Rs.1,899</td>
                        <td>Khalti</td>

                        <td>

                            <span class="status processing">

                                Processing

                            </span>

                        </td>

                        <td>

                            <a href="#" class="view-btn">View</a>

                        </td>

                    </tr>

                    <?php endif; ?>
                </tbody>

            </table>

        </div>

    </main>

</div>
<?php include("../includes/admin-footer.php"); ?>
