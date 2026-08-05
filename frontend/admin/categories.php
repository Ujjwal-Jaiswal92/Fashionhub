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

            <li class="active"><a href="categories.php"><i class="fas fa-list"></i> Categories</a></li>

            <li><a href="orders.php"><i class="fas fa-box"></i> Orders</a></li>

            <li><a href="users.php"><i class="fas fa-users"></i> Users</a></li>

            <li><a href="reports.php"><i class="fas fa-chart-line"></i> Reports</a></li>

            <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>

            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>

        </ul>

    </aside>

    <!-- Main Content -->

    <main class="main-content">

        <div class="topbar">

            <h1>Categories</h1>

            <a href="#" class="add-btn">+ Add Category</a>

        </div>

        <div class="table-container">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Total Products</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td>1</td>
                        <td>Men</td>
                        <td>45</td>

                        <td>

                            <a href="#" class="edit-btn">Edit</a>

                            <a href="#" class="delete-btn">Delete</a>

                        </td>

                    </tr>

                    <tr>

                        <td>2</td>
                        <td>Women</td>
                        <td>52</td>

                        <td>

                            <a href="#" class="edit-btn">Edit</a>

                            <a href="#" class="delete-btn">Delete</a>

                        </td>

                    </tr>

                    <tr>

                        <td>3</td>
                        <td>Kids</td>
                        <td>26</td>

                        <td>

                            <a href="#" class="edit-btn">Edit</a>

                            <a href="#" class="delete-btn">Delete</a>

                        </td>

                    </tr>

                    <tr>

                        <td>4</td>
                        <td>Sale</td>
                        <td>18</td>

                        <td>

                            <a href="#" class="edit-btn">Edit</a>

                            <a href="#" class="delete-btn">Delete</a>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </main>

</div>
<?php include("../includes/admin-footer.php"); ?>
