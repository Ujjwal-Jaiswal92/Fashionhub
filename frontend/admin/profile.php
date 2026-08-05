<?php
require_once '../../backend/middleware/admin.php';
require_once '../../backend/models/User.php';
$adminUser = (new User())->getById($_SESSION['user_id']);
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

            <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>

            <li class="active"><a href="profile.php"><i class="fas fa-user"></i> Profile</a></li>

            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>

        </ul>

    </aside>

    <!-- Main Content -->

    <main class="main-content">

        <div class="topbar">

            <h1>Admin Profile</h1>

        </div>

        <div class="profile-container">

            <div class="profile-image">

                <img src="../assets/images/users/user1.jpg" alt="Admin">

                <button class="upload-btn">

                    Change Photo

                </button>

            </div>

            <div class="profile-form">

                <?php if (isset($_GET['success'])): ?><p>Profile updated.</p><?php endif; ?>
                <form action="../../backend/api/admin.php?action=update-profile" method="POST">

                    <div class="form-group">

                        <label>Full Name</label>

                        <input type="text" name="full_name" value="<?= htmlspecialchars($adminUser['full_name']) ?>" required>

                    </div>

                    <div class="form-group">

                        <label>Email Address</label>

                        <input type="email" name="email" value="<?= htmlspecialchars($adminUser['email']) ?>" required>

                    </div>

                    <div class="form-group">

                        <label>Phone Number</label>

                        <input type="text" name="phone" value="<?= htmlspecialchars($adminUser['phone'] ?? '') ?>">

                    </div>

                    <div class="form-group">

                        <label>Address</label>

                        <input type="text" name="address" value="<?= htmlspecialchars($adminUser['address'] ?? '') ?>">

                    </div>

                    <div class="form-group">

                        <label>New Password</label>

                        <input type="password" name="new_password" placeholder="Leave blank to keep current password">

                    </div>

                    <div class="form-group">

                        <label>Confirm Password</label>

                        <input type="password" name="confirm_password" placeholder="Confirm new password">

                    </div>

                <button class="save-btn" type="submit">

                        Update Profile

                    </button>

                </form>

            </div>

        </div>

    </main>

</div>
<?php include("../includes/admin-footer.php"); ?>
