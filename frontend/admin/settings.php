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

            <form>

                <div class="form-group">

                    <label>Website Name</label>

                    <input type="text" value="FashionHub">

                </div>

                <div class="form-group">

                    <label>Support Email</label>

                    <input type="email" value="support@fashionhub.com">

                </div>

                <div class="form-group">

                    <label>Contact Number</label>

                    <input type="text" value="+977 98XXXXXXXX">

                </div>

                <div class="form-group">

                    <label>Store Address</label>

                    <textarea rows="4">NCIT, Balkumari, Lalitpur, Nepal</textarea>

                </div>

                <div class="form-group">

                    <label>Currency</label>

                    <select>

                        <option selected>Nepalese Rupee (NPR)</option>

                        <option>Indian Rupee (INR)</option>

                        <option>US Dollar (USD)</option>

                    </select>

                </div>

                <button class="save-btn">

                    Save Settings

                </button>

            </form>

        </div>

    </main>

</div>
<?php include("../includes/admin-footer.php"); ?>