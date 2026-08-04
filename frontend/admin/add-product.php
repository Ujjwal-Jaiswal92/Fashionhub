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
            <li class="active"><a href="products.php"><i class="fas fa-tshirt"></i> Products</a></li>
            <li><a href="categories.php"><i class="fas fa-list"></i> Categories</a></li>
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

            <h1>Add Product</h1>

        </div>

        <div class="form-container">

            <form action="../../backend/api/products.php" method="POST" enctype="multipart/form-data">

                <div class="form-group">

                    <label>Product Name</label>

                    <input type="text" name="name" required>

                </div>

                <div class="form-group">

                    <label>Category</label>

                    <select name="category" required>

                        <option value="">Select Category</option>
                        <option>Men</option>
                        <option>Women</option>
                        <option>Kids</option>
                        <option>Sale</option>

                    </select>

                </div>

                <div class="form-group">

                    <label>Price</label>

                    <input type="number" name="price" required>

                </div>

                <div class="form-group">

                    <label>Stock</label>

                    <input type="number" name="stock" required>

                </div>

                <div class="form-group">

                    <label>Description</label>

                    <textarea name="description" rows="5"></textarea>

                </div>

                <div class="form-group">

                    <label>Product Image</label>

                    <input type="file" name="image">

                </div>

                <button type="submit" class="save-btn">

                    Save Product

                </button>

            </form>

        </div>

    </main>

</div>
<?php include("../includes/admin-footer.php"); ?>