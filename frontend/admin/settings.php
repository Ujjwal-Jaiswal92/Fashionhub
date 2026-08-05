<?php
require_once '../../backend/middleware/admin.php';
require_once '../../backend/config/database.php';
$db = (new Database())->connect();
$settings = $db->query('SELECT setting_key, setting_value FROM site_settings')->fetchAll(PDO::FETCH_KEY_PAIR);
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

            <li><a href="reports.php"><i class="fas fa-chart-line"></i> Reports</a></li>

            <li class="active"><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>

            <li><a href="profile.php"><i class="fas fa-user"></i> Profile</a></li>

            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>

        </ul>

    </aside>

    <!-- Main Content -->

    <main class="main-content">

        <div class="topbar">

            <h1>Website Settings</h1>

        </div>

        <div class="form-container">

            <?php if (isset($_GET['success'])): ?><p>Settings saved.</p><?php endif; ?>
            <form action="../../backend/api/admin.php?action=save-settings" method="POST">

                <div class="form-group">

                    <label>Website Name</label>

                    <input type="text" name="website_name" value="<?= htmlspecialchars($settings['website_name'] ?? 'FashionHub') ?>" required>

                </div>

                <div class="form-group">

                    <label>Support Email</label>

                    <input type="email" name="support_email" value="<?= htmlspecialchars($settings['support_email'] ?? '') ?>" required>

                </div>

                <div class="form-group">

                    <label>Contact Number</label>

                    <input type="text" name="contact_number" value="<?= htmlspecialchars($settings['contact_number'] ?? '') ?>">

                </div>

                <div class="form-group">

                    <label>Store Address</label>

                    <textarea name="store_address" rows="4"><?= htmlspecialchars($settings['store_address'] ?? '') ?></textarea>

                </div>

                <div class="form-group">

                    <label>Currency</label>

                    <select name="currency">

                        <option value="NPR" <?= ($settings['currency'] ?? 'NPR') === 'NPR' ? 'selected' : '' ?>>Nepalese Rupee (NPR)</option>

                        <option value="INR" <?= ($settings['currency'] ?? '') === 'INR' ? 'selected' : '' ?>>Indian Rupee (INR)</option>

                        <option value="USD" <?= ($settings['currency'] ?? '') === 'USD' ? 'selected' : '' ?>>US Dollar (USD)</option>

                    </select>

                </div>

                <button class="save-btn" type="submit">

                    Save Settings

                </button>

            </form>

        </div>

    </main>

</div>
<?php include("../includes/admin-footer.php"); ?>
