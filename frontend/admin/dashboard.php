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

                <h2>120</h2>

            </div>

            <div class="card">

                <h3>Total Orders</h3>

                <h2>86</h2>

            </div>

            <div class="card">

                <h3>Total Users</h3>

                <h2>245</h2>

            </div>

            <div class="card">

                <h3>Revenue</h3>

                <h2>Rs. 2,45,000</h2>

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

                </tbody>

            </table>

        </div>

    </main>

</div>
<?php include("../includes/admin-footer.php"); ?>