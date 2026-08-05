<header class="header">

    <div class="top-bar">
        <p>🚚 Free Shipping on Orders Over Rs. 3000</p>
    </div>

    <nav class="navbar">

        <!-- Logo -->
        <div class="logo">
            <a href="index.php">FashionHub</a>
        </div>

        <?php $isSeller = isset($_SESSION['user_id']) && ($_SESSION['role'] ?? '') === 'seller'; ?>
        <?php if (!$isSeller): ?>
        <div class="search-box">
            <input type="text" placeholder="Search Products...">
            <button>
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>
        <?php endif; ?>

        <!-- Navigation -->

        <ul class="nav-links">
        <?php if ($isSeller): ?>
            <li><a href="index.php">Shop</a></li>
            <li><a href="seller-dashboard.php">Seller Dashboard</a></li>
            <li><a href="seller-products.php">My Products</a></li>
        <?php else: ?>

            <li><a href="index.php">Home</a></li>

            <li><a href="products.php">Men</a></li>

            <li><a href="products.php">Women</a></li>

            <li><a href="products.php">Kids</a></li>

            <li><a href="#">Sale</a></li>

            <li><a href="contact.php">Contact</a></li>
        <?php endif; ?>

        </ul>

        <!-- Icons -->

        <div class="nav-icons">

            <a href="<?= isset($_SESSION['user_id']) ? (($_SESSION['role'] ?? '') === 'seller' ? 'seller-dashboard.php' : 'profile.php') : 'login.php' ?>">
                <i class="fa-regular fa-user"></i>
            </a>

            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="../../backend/api/auth.php?action=logout" title="Logout"><i class="fa-solid fa-right-from-bracket"></i></a>
            <?php endif; ?>

            <?php if (!$isSeller): ?><a href="cart.php">
                <i class="fa-solid fa-cart-shopping"></i>
            </a><?php endif; ?>

        </div>

    </nav>

</header>
