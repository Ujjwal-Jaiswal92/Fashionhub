<?php include("../includes/header.php"); ?>
<?php include("../includes/navbar.php"); ?>

<!-- ================= PRODUCT DETAILS ================= -->

<section class="product-details">

    <!-- Left Side -->

    <div class="product-gallery">

        <img src="../assets/images/products/product1.jpg" class="main-image" alt="Classic Shirt">

        <div class="thumbnail-images">

            <img src="../assets/images/products/product1.jpg" alt="">
            <img src="../assets/images/products/product2.jpg" alt="">
            <img src="../assets/images/products/product3.jpg" alt="">
            <img src="../assets/images/products/product4.jpg" alt="">

        </div>

    </div>

    <!-- Right Side -->

    <div class="product-info-details">

        <span class="product-category">
            Men
        </span>

        <h1>
            Classic Cotton Shirt
        </h1>

        <div class="rating">
            ★★★★★ (125 Reviews)
        </div>

        <div class="product-price">

            Rs. 2,499

        </div>

        <p>

            Premium quality cotton shirt designed for comfort and style.
            Perfect for casual and formal occasions.

        </p>

        <!-- Size -->

        <h3>Select Size</h3>

        <div class="sizes">

            <button>S</button>
            <button>M</button>
            <button>L</button>
            <button>XL</button>

        </div>

        <!-- Quantity -->

        <h3>Quantity</h3>

        <input type="number" value="1" min="1">

        <div class="product-buttons">

            <button class="cart-btn">
                Add to Cart
            </button>

            <button class="buy-btn">
                Buy Now
            </button>

        </div>

    </div>

</section>

<?php include("../includes/footer.php"); ?>