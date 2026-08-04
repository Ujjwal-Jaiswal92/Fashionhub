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

                </tbody>

            </table>

        </div>

    </main>

</div>
<?php include("../includes/admin-footer.php"); ?>