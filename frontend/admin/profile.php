<?php include("../includes/header.php"); ?>
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

                <form>

                    <div class="form-group">

                        <label>Full Name</label>

                        <input type="text" value="Administrator">

                    </div>

                    <div class="form-group">

                        <label>Email Address</label>

                        <input type="email" value="admin@fashionhub.com">

                    </div>

                    <div class="form-group">

                        <label>Phone Number</label>

                        <input type="text" value="+977 98XXXXXXXX">

                    </div>

                    <div class="form-group">

                        <label>New Password</label>

                        <input type="password" placeholder="Leave blank to keep current password">

                    </div>

                    <div class="form-group">

                        <label>Confirm Password</label>

                        <input type="password" placeholder="Confirm new password">

                    </div>

                    <button class="save-btn">

                        Update Profile

                    </button>

                </form>

            </div>

        </div>

    </main>

</div>
<?php include("../includes/admin-footer.php"); ?>