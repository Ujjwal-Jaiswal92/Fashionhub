<?php
require_once '../../backend/controllers/ProductController.php';
$filters = [
    'categories' => $_GET['categories'] ?? ($_GET['category'] ?? []),
    'price' => $_GET['price'] ?? '',
    'sort' => $_GET['sort'] ?? '',
    'search' => $_GET['search'] ?? '',
];
$selectedCategories = array_map(static function ($category) {
    $category = strtolower(trim((string)$category));
    return match ($category) {
        'women', 'womens', "women's" => 'female',
        'kids', "kid's" => 'kid',
        'male', 'mens', "men's" => 'men',
        default => $category,
    };
}, (array)$filters['categories']);
$products = (new ProductController())->getApprovedProducts($filters);
include("../includes/header.php");
?>
<?php include("../includes/navbar.php"); ?>

<!-- ================= PRODUCTS BANNER ================= -->

<section class="page-banner">

    <h1>Our Collection</h1>

    <p>Explore the latest fashion for Men, Female and Kid.</p>

</section>

<!-- ================= PRODUCTS ================= -->

<section class="products-page">

    <!-- Sidebar -->

    <form class="filter-sidebar" method="GET">

        <h3>Categories</h3>

        <label><input type="checkbox" name="categories[]" value="Men" <?= in_array('men', $selectedCategories, true) ? 'checked' : '' ?>> Men</label>

        <label><input type="checkbox" name="categories[]" value="Female" <?= in_array('female', $selectedCategories, true) ? 'checked' : '' ?>> Female</label>

        <label><input type="checkbox" name="categories[]" value="Kid" <?= in_array('kid', $selectedCategories, true) ? 'checked' : '' ?>> Kid</label>

        <label><input type="checkbox" name="categories[]" value="Sale" <?= in_array('sale', $selectedCategories, true) ? 'checked' : '' ?>> Sale</label>

        <hr>

        <h3>Price</h3>

        <label><input type="radio" name="price" value="0-1000" <?= $filters['price'] === '0-1000' ? 'checked' : '' ?>> Rs.0 - Rs.1000</label>

        <label><input type="radio" name="price" value="1000-3000" <?= $filters['price'] === '1000-3000' ? 'checked' : '' ?>> Rs.1000 - Rs.3000</label>

        <label><input type="radio" name="price" value="3000-plus" <?= $filters['price'] === '3000-plus' ? 'checked' : '' ?>> Rs.3000+</label>

        <button class="cart-btn" type="submit">Apply Filters</button>
        <a href="products.php">Clear Filters</a>

    </form>

    <!-- Products -->

    <div class="products-content">

        <div class="products-top">

            <p>Showing <?= count($products) ?> Products</p>

            <form method="GET"><input type="hidden" name="category" value="<?= htmlspecialchars(is_array($filters['categories']) ? '' : $filters['categories']) ?>"><input type="hidden" name="price" value="<?= htmlspecialchars($filters['price']) ?>"><input type="hidden" name="search" value="<?= htmlspecialchars($filters['search']) ?>"><select name="sort" onchange="this.form.submit()">

                <option value="">Sort By</option>

                <option value="newest" <?= $filters['sort'] === 'newest' ? 'selected' : '' ?>>Newest</option>

                <option value="price_asc" <?= $filters['sort'] === 'price_asc' ? 'selected' : '' ?>>Price: Low to High</option>

                <option value="price_desc" <?= $filters['sort'] === 'price_desc' ? 'selected' : '' ?>>Price: High to Low</option>

            </select></form>

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
