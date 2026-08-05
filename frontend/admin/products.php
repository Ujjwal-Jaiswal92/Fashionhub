<?php
require_once '../../backend/middleware/admin.php';
require_once '../../backend/controllers/ProductController.php';
$adminProducts = (new ProductController())->getAllProducts();
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

            <li class="active"><a href="products.php"><i class="fas fa-tshirt"></i> Products</a></li>

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

            <h1>Products</h1>

            <span>Seller-submitted products</span>

        </div>

        <div class="table-container">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Image</th>

                        <th>Name</th>

                        <th>Category</th>

                        <th>Price</th>

                        <th>Stock</th>

                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>
                    <?php foreach ($adminProducts as $product): ?>
                    <tr>
                        <td><?= (int)$product['product_id'] ?></td>
                        <td><img src="../../uploads/products/<?= htmlspecialchars($product['image'] ?: 'placeholder.png') ?>" class="product-img"></td>
                        <td><?= htmlspecialchars($product['product_name']) ?><br><small>Seller: <?= htmlspecialchars($product['seller_name']) ?></small></td>
                        <td><?= htmlspecialchars($product['category_name']) ?></td>
                        <td>Rs. <?= number_format((float)$product['price'], 2) ?></td>
                        <td><?= (int)$product['stock'] ?></td>
                        <td>
                            <strong><?= htmlspecialchars($product['status']) ?></strong><br>
                            <?php if ($product['status'] === 'Pending'): ?><a href="../../backend/api/products.php?action=approve&id=<?= (int)$product['product_id'] ?>" class="edit-btn">Approve</a><?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (false): ?>
                    <tr>

                        <td>1</td>

                        <td>

                            <img src="../assets/images/products/product1.jpg" class="product-img">

                        </td>

                        <td>Classic Shirt</td>

                        <td>Men</td>

                        <td>Rs.2499</td>

                        <td>25</td>

                        <td>

                            <a href="edit-product.php" class="edit-btn">Edit</a>

                            <a href="#" class="delete-btn">Delete</a>

                        </td>

                    </tr>

                    <tr>

                        <td>2</td>

                        <td>

                            <img src="../assets/images/products/product2.jpg" class="product-img">

                        </td>

                        <td>Women's Dress</td>

                        <td>Women</td>

                        <td>Rs.2999</td>

                        <td>18</td>

                        <td>

                            <a href="edit-product.php" class="edit-btn">Edit</a>

                            <a href="#" class="delete-btn">Delete</a>

                        </td>

                    </tr>

                    <?php endif; ?>
                </tbody>

            </table>

        </div>

    </main>

</div>
<?php include("../includes/admin-footer.php"); ?>
