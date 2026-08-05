<?php
require_once '../../backend/controllers/ProductController.php';
$products = (new ProductController())->getApprovedProducts();
include("../includes/header.php");
?>
<?php include("../includes/navbar.php"); ?>

<!-- ================= PRODUCTS BANNER ================= -->

<section class="page-banner">

    <h1>Our Collection</h1>

    <p>Explore the latest fashion for Men, Women and Kids.</p>

</section>

<!-- ================= PRODUCTS ================= -->

<section class="products-page">

    <!-- Sidebar -->

    <aside class="filter-sidebar">

        <h3>Categories</h3>

        <label><input type="checkbox"> Men</label>

        <label><input type="checkbox"> Women</label>

        <label><input type="checkbox"> Kids</label>

        <label><input type="checkbox"> Sale</label>

        <hr>

        <h3>Price</h3>

        <label><input type="radio" name="price"> Rs.0 - Rs.1000</label>

        <label><input type="radio" name="price"> Rs.1000 - Rs.3000</label>

        <label><input type="radio" name="price"> Rs.3000+</label>

    </aside>

    <!-- Products -->

    <div class="products-content">

        <div class="products-top">

            <p>Showing <?= count($products) ?> Products</p>

            <select>

                <option>Sort By</option>

                <option>Newest</option>

                <option>Price: Low to High</option>

                <option>Price: High to Low</option>

            </select>

        </div>

        <div class="product-grid">
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <div class="product-image"><img src="../../uploads/products/<?= htmlspecialchars($product['image'] ?: 'placeholder.png') ?>" alt="<?= htmlspecialchars($product['product_name']) ?>"></div>
                    <div class="product-info">
                        <span class="category"><?= htmlspecialchars($product['category_name']) ?></span>
                        <h3><?= htmlspecialchars($product['product_name']) ?></h3>
                        <div class="price">Rs. <?= number_format((float)$product['price'], 2) ?></div><br>
                        <a class="cart-btn" href="product-details.php?id=<?= (int)$product['product_id'] ?>">View Details</a>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php if (!$products): ?><p>No approved products are available yet.</p><?php endif; ?>
            <?php if (false): ?>

            <!-- Products will be added next -->
             <div class="product-grid">

    <!-- Product 1 -->
    <div class="product-card">
        <div class="product-image">
            <img src="../assets/images/products/new1.jpg" alt="Classic Shirt">
            <span class="badge">New</span>

            <div class="product-icons">
                <a href="#"><i class="fa-regular fa-heart"></i></a>
                <a href="#"><i class="fa-solid fa-eye"></i></a>
            </div>
        </div>

        <div class="product-info">
            <span class="category">Men</span>
            <h3>Classic Shirt</h3>
            <div class="rating">★★★★★</div>
            <div class="price">Rs. 2,499</div>
            <button class="cart-btn">Add to Cart</button>
        </div>
    </div>

    <!-- Product 2 -->
    <div class="product-card">
        <div class="product-image">
            <img src="../assets/images/products/productG.png" alt="Denim Jacket">
        </div>

        <div class="product-info">
            <span class="category">Men</span>
            <h3>Denim Jacket</h3>
            <div class="rating">★★★★★</div>
            <div class="price">Rs. 3,999</div>
            <button class="cart-btn">Add to Cart</button>
        </div>
    </div>

    <!-- Product 3 -->
    <div class="product-card">
        <div class="product-image">
            <img src="../assets/images/products/productB.png" alt="Summer Dress">
        </div>

        <div class="product-info">
            <span class="category">Women</span>
            <h3>Summer Dress</h3>
            <div class="rating">★★★★☆</div>
            <div class="price">Rs. 2,999</div>
            <button class="cart-btn">Add to Cart</button>
        </div>
    </div>

    <!-- Product 4 -->
    <div class="product-card">
        <div class="product-image">
            <img src="../assets/images/products/productE.png" alt="Oversized Hoodie">
            <span class="badge sale">50% OFF</span>
        </div>

        <div class="product-info">
            <span class="category">Women</span>
            <h3>Oversized Hoodie</h3>
            <div class="rating">★★★★★</div>

            <div class="price">
                <span class="old-price">Rs. 3,999</span>
                <span class="sale-price">Rs. 1,999</span>
            </div>

            <button class="cart-btn">Add to Cart</button>
        </div>
    </div>

    <!-- Product 5 -->
    <div class="product-card">
        <div class="product-image">
            <img src="../assets/images/products/product2.jpg" alt="Knitted Sweater">
        </div>

        <div class="product-info">
            <span class="category">Women</span>
            <h3>Knitted Sweater</h3><br>
            <div class="rating">★★★★★</div><br>
            <div class="price">Rs. 2,799</div><br>
            <button class="cart-btn">Add to Cart</button>
        </div>
    </div>

    <!-- Product 6 -->
    <div class="product-card">
        <div class="product-image">
            <img src="../assets/images/products/product4.jpg" alt="High Waist Jeans">
        </div>

        <div class="product-info">
            <span class="category">Women</span>
            <h3>High Waist Jeans</h3><br>
            <div class="rating">★★★★☆</div><br>
            <div class="price">Rs. 2,699</div><br>
            <button class="cart-btn">Add to Cart</button>
        </div>
    </div>

    <!-- Product 7 -->
    <div class="product-card">
        <div class="product-image">
            <img src="../assets/images/products/product3.jpg" alt="Kids T-Shirt">
        </div>

        <div class="product-info">
            <span class="category">Kids</span>
            <h3>Kids Cotton T-Shirt</h3><br>
            <div class="rating">★★★★★</div><br>
            <div class="price">Rs. 1,299</div><br>
            <button class="cart-btn">Add to Cart</button>
        </div>
    </div>

    <!-- Product 8 -->
    <div class="product-card">
        <div class="product-image">
            <img src="../assets/images/products/new3.jpg" alt="Kids Jacket">
        </div>

        <div class="product-info">
            <span class="category">Kids</span>
            <h3>Kids Jacket</h3><br>
            <div class="rating">★★★★★</div><br>
            <div class="price">Rs. 2,199</div><br>
            <button class="cart-btn">Add to Cart</button>
        </div>
    </div>

</div>
<?php endif; ?>

        </div>

    </div>

</section>

<?php include("../includes/footer.php"); ?>
