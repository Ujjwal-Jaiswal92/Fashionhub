<?php require_once '../../backend/middleware/admin.php'; include("../includes/header.php"); ?>
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
            <li class="active"><a href="users.php"><i class="fas fa-users"></i> Users</a></li>
            <li><a href="reports.php"><i class="fas fa-chart-line"></i> Reports</a></li>
            <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>

        </ul>

    </aside>

    <!-- Main Content -->

    <main class="main-content">

        <div class="topbar">

            <h1>Users</h1>

        </div>

        <div class="table-container">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Joined</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>
                    <tr><td colspan="8">No user records are displayed here until connected to the user-management workflow.</td></tr>
                    <?php if (false): ?>

                    <tr>

                        <td>1</td>

                        <td>
                            <img src="../assets/images/users/user1.jpg" class="user-img">
                        </td>

                        <td>Srijana Uranw</td>

                        <td>srijana@gmail.com</td>

                        <td>9800000001</td>

                        <td>01 Aug 2026</td>

                        <td>

                            <span class="status active-user">

                                Active

                            </span>

                        </td>

                        <td>

                            <a href="#" class="edit-btn">Edit</a>

                            <a href="#" class="delete-btn">Delete</a>

                        </td>

                    </tr>

                    <tr>

                        <td>2</td>

                        <td>
                            <img src="../assets/images/users/user2.jpg" class="user-img">
                        </td>

                        <td>Ram Sharma</td>

                        <td>ram@gmail.com</td>

                        <td>9811111111</td>

                        <td>03 Aug 2026</td>

                        <td>

                            <span class="status blocked-user">

                                Blocked

                            </span>

                        </td>

                        <td>

                            <a href="#" class="edit-btn">Edit</a>

                            <a href="#" class="delete-btn">Delete</a>

                        </td>

                    </tr>

                </tbody><?php endif; ?>

            </table>

        </div>

    </main>

</div>
<?php include("../includes/admin-footer.php"); ?>
