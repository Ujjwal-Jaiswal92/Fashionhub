<?php
require_once '../../backend/controllers/ProductController.php';
$featuredProducts = (new ProductController())->getApprovedProducts();
include("../includes/header.php");
?>
<?php include("../includes/navbar.php"); ?>

<main>

    <!-- ================= HERO SECTION ================= -->

    <section class="hero">

        <div class="hero-content">

            <span class="hero-subtitle">New Collection 2026</span>

            <h1>Discover Your <span>Perfect Style</span></h1>

            <p>
                Explore premium fashion for Men, Women & Kids.
                Elevate your wardrobe with our latest collections.
            </p>

            <div class="hero-buttons">

                <a href="products.php" class="btn-primary">
                    Shop Now
                </a>

                <a href="products.php" class="btn-secondary">
                    Explore Collection
                </a>

            </div>

        </div>

        <div class="hero-image">

            <img src="../assets/images/banners/hero.png"
                alt="Fashion Model">

        </div>

    </section>

    <!-- HERO END -->
     <!-- ================= CATEGORIES SECTION ================= -->

<section class="categories">

    <div class="section-title">
        <h2>Shop by Category</h2>
        <p>Find your favorite fashion collection</p>
    </div>

    <div class="category-container">

        <div class="category-card">
            <img src="../assets/images/categories/men.jpg" alt="Men">
            <div class="category-overlay">
                <h3>Men</h3>
                <a href="products.php?category=men">Shop Now</a>
            </div>
        </div>

        <div class="category-card">
            <img src="../assets/images/categories/women.jpg" alt="Women">
            <div class="category-overlay">
                <h3>Women</h3>
                <a href="products.php?category=women">Shop Now</a>
            </div>
        </div>

        <div class="category-card">
            <img src="../assets/images/categories/kids.jpg" alt="Kids">
            <div class="category-overlay">
                <h3>Kids</h3>
                <a href="products.php?category=kids">Shop Now</a>
            </div>
        </div>

        <div class="category-card">
            <img src="../assets/images/categories/sale.jpg" alt="Accessories">
            <div class="category-overlay">
                <h3>Sale</h3>
                <a href="products.php?category=accessories">Shop Now</a>
            </div>
        </div>

    </div>

</section>

<!-- ================= END CATEGORIES ================= -->
 <!-- ================= FEATURED PRODUCTS ================= -->

<section class="featured-products">

    <div class="section-title">
        <h2>Featured Products</h2>
        <p>Discover our best-selling fashion collection</p>
    </div>

    <div class="product-grid">
        <?php foreach (array_slice($featuredProducts, 0, 4) as $product): ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="../../uploads/products/<?= htmlspecialchars($product['image'] ?: 'placeholder.png') ?>" alt="<?= htmlspecialchars($product['product_name']) ?>">
                </div>
                <div class="product-info">
                    <span class="category"><?= htmlspecialchars($product['category_name']) ?></span>
                    <h3><?= htmlspecialchars($product['product_name']) ?></h3>
                    <div class="price">Rs. <?= number_format((float)$product['price'], 2) ?></div><br>
                    <a class="cart-btn" href="product-details.php?id=<?= (int)$product['product_id'] ?>">View Details</a>
                </div>
            </div>
        <?php endforeach; ?>
        <?php if (!$featuredProducts): ?><p>No approved products are available yet.</p><?php endif; ?>
        <?php if (false): ?>

        <!-- Product 1 -->
        <div class="product-card">

            <div class="product-image">

                <img src="../assets/images/products/product1.jpg" alt="Product">

                <span class="badge">New</span>

                <div class="product-icons">

                    <a href="#"><i class="fa-regular fa-heart"></i></a>

                    <a href="#"><i class="fa-solid fa-eye"></i></a>

                </div>

            </div>

            <div class="product-info">

                <span class="category">Men</span>

                <h3>High Quality Hoodie</h3>
                 <br>
                <div class="rating">
                    ★★★★★
                </div> <br>

                <div class="price">
                    Rs. 3,999
                </div>
                   <br>
                <button class="cart-btn">
                    Add to Cart
                </button>

            </div>

        </div>

        <!-- Product 2 -->

        <div class="product-card">

            <div class="product-image">

                <img src="../assets/images/products/product2.jpg" alt="Product">

                <span class="badge sale">Sale</span>

                <div class="product-icons">

                    <a href="#"><i class="fa-regular fa-heart"></i></a>

                    <a href="#"><i class="fa-solid fa-eye"></i></a>

                </div>

            </div>

            <div class="product-info">

                <span class="category">Women</span>

                <h3>Knitted Sweater</h3>
                    <br>
                <div class="rating">
                    ★★★★☆
                </div>
                    <br>
                <div class="price">
                    Rs. 2,499
                </div>
                    <br>
                <button class="cart-btn">
                    Add to Cart
                </button>

            </div>

        </div>

        <!-- Product 3 -->

        <div class="product-card">

            <div class="product-image">

                <img src="../assets/images/products/product3.jpg" alt="Product">

                <div class="product-icons">

                    <a href="#"><i class="fa-regular fa-heart"></i></a>

                    <a href="#"><i class="fa-solid fa-eye"></i></a>

                </div>

            </div>

            <div class="product-info">

                <span class="category">Kids</span>

                <h3>Kids T-Shirt</h3>
                     <br>
                <div class="rating">
                    ★★★★★
                </div><br>
            
                <div class="price">
                    Rs. 1,899
                </div><br>

                <button class="cart-btn">
                    Add to Cart
                </button>

            </div>

        </div>
<!-- Product 4 -->

<div class="product-card">

    <div class="product-image">

        <img src="../assets/images/products/product4.jpg" alt="Oversized Hoodie">

        <span class="badge sale">50% OFF</span>

        <div class="product-icons">

            <a href="#"><i class="fa-regular fa-heart"></i></a>

            <a href="#"><i class="fa-solid fa-eye"></i></a>

        </div>

    </div>

    <div class="product-info">

        <span class="category">Women</span>

        <h3>High Waist Wide Leg Pants</h3><br>

        <div class="rating">
            ★★★★★
        </div><br>

        
        <div class="price">
                        <span class="old-price">Rs. 3,999</span>
                        <span class="sale-price">Rs. 1,999</span>
                    </div><br>


        <button class="cart-btn">
            Add to Cart
        </button>

    </div>

</div>

        </div>
        <?php endif; ?>

    </div>

</section>
<!-- ================= WHY CHOOSE US ================= -->

<section class="why-us">

    <div class="section-title">
        <h2>Why Choose FashionHub?</h2>
        <p>We provide the best shopping experience for our customers.</p>
    </div>

    <div class="why-container">

        <div class="why-card">
            <i class="fa-solid fa-truck-fast"></i>
            <h3>Free Shipping</h3>
            <p>Enjoy free delivery on orders above Rs. 3000.</p>
        </div>

        <div class="why-card">
            <i class="fa-solid fa-rotate-left"></i>
            <h3>Easy Returns</h3>
            <p>7-day hassle-free return and exchange policy.</p>
        </div>

        <div class="why-card">
            <i class="fa-solid fa-credit-card"></i>
            <h3>Secure Payment</h3>
            <p>100% secure online payment with trusted gateways.</p>
        </div>

        <div class="why-card">
            <i class="fa-solid fa-medal"></i>
            <h3>Premium Quality</h3>
            <p>High-quality clothing with the latest fashion trends.</p>
        </div>

    </div>

</section>
<!-- ================= NEW ARRIVALS ================= -->
<?php if (false): ?>
<section class="new-arrivals">

    <div class="section-title">
        <h2>New Arrivals</h2>
        <p>Discover the latest fashion trends just added to our collection.</p>
    </div>

    <div class="arrival-grid">

        <!-- Product 1 -->
        <div class="arrival-card">

            <img src="../assets/images/products/new1.jpg" alt="Formal Shirt">

            <div class="arrival-content">

                <span>Men</span>

                <h3>Formal White Shirt</h3>

                <div class="arrival-price">
                    Rs. 2,499
                </div>

                <a href="#" class="arrival-btn">View Details</a>

            </div>

        </div>

        <!-- Product 2 -->

        <div class="arrival-card">

            <img src="../assets/images/products/new2.jpg" alt="Dress">

            <div class="arrival-content">

                <span>Women</span>

                <h3>Elegant Floral Dress</h3>

                <div class="arrival-price">
                    Rs. 3,299
                </div>

                <a href="#" class="arrival-btn">View Details</a>

            </div>

        </div>

        <!-- Product 3 -->

        <div class="arrival-card">

            <img src="../assets/images/products/new3.jpg" alt="Kids">

            <div class="arrival-content">

                <span>Kids</span>

                <h3>Cotton Kids T-Shirt</h3>

                <div class="arrival-price">
                    Rs. 1,299
                </div>

                <a href="#" class="arrival-btn">View Details</a>

            </div>

        </div>

    </div>

</section>
<?php endif; ?>
<!-- ================= SALE BANNER ================= -->

<section class="sale-banner">

    <div class="sale-content">

        <span>Limited Time Offer</span>

        <h2>End of Season Sale</h2>

        <h1>UP TO 50% OFF</h1>

        <p>
            Refresh your wardrobe with amazing discounts on selected collections.
        </p>

        <a href="products.php?category=sale" class="sale-btn">
            Shop Sale
        </a>

    </div>

</section>
<!-- ================= TESTIMONIALS ================= -->

<section class="testimonials">

    <div class="section-title">
        <h2>What Our Customers Say</h2>
        <p>Trusted by hundreds of happy customers across Nepal.</p>
    </div>

    <div class="testimonial-container">

        <!-- Testimonial 1 -->
        <div class="testimonial-card">

            <img src="../assets/images/users/user1.jpg" alt="Customer">

            <h3>Aarav Sharma</h3>

            <div class="stars">
                ★★★★★
            </div>

            <p>
                Amazing quality! The fabric is soft, and the delivery was quick. I'll definitely shop again.
            </p>

        </div>

        <!-- Testimonial 2 -->
        <div class="testimonial-card">

            <img src="../assets/images/users/user2.jpg" alt="Customer">

            <h3>Priya Koirala</h3>

            <div class="stars">
                ★★★★★
            </div>

            <p>
                FashionHub has become my favorite clothing store. The designs are trendy and affordable.
            </p>

        </div>

        <!-- Testimonial 3 -->
        <div class="testimonial-card">

            <img src="../assets/images/users/user3.jpg" alt="Customer">

            <h3>Suman Thapa</h3>

            <div class="stars">
                ★★★★★
            </div>

            <p>
                Excellent customer service and premium quality products. Highly recommended!
            </p>

        </div>

    </div>

</section>

<!-- ================= END SALE BANNER ================= -->

<!-- ================= END FEATURED PRODUCTS ================= -->
 <!-- ================= NEWSLETTER ================= -->

<section class="newsletter">

    <div class="newsletter-content">

        <h2>Subscribe to Our Newsletter</h2>

        <p>
            Get updates about new arrivals, exclusive offers, and fashion trends.
        </p>

        <form action="#" method="POST" class="newsletter-form">

            <input
                type="email"
                name="email"
                placeholder="Enter your email address"
                required
            >

            <button type="submit">
                Subscribe
            </button>

        </form>

    </div>

</section>

<!-- ================= END NEWSLETTER ================= -->
 <!-- ================= FOOTER ================= -->

<footer class="footer">

    <div class="footer-container">

        <!-- Column 1 -->

        <div class="footer-column">

            <h2>FashionHub</h2>

            <p>
                FashionHub is your one-stop destination for stylish clothing for Men, Women, and Kids. Discover the latest trends at affordable prices.
            </p>

            <div class="social-icons">

                <a href="#"><i class="fab fa-facebook-f"></i></a>

                <a href="#"><i class="fab fa-instagram"></i></a>

                <a href="#"><i class="fab fa-twitter"></i></a>

                <a href="#"><i class="fab fa-linkedin-in"></i></a>

            </div>

        </div>

        <!-- Column 2 -->

        <div class="footer-column">

            <h3>Quick Links</h3>

            <ul>

                <li><a href="index.php">Home</a></li>

                <li><a href="products.php">Products</a></li>

                <li><a href="about.php">About</a></li>

                <li><a href="contact.php">Contact</a></li>

            </ul>

        </div>

        <!-- Column 3 -->

        <div class="footer-column">

            <h3>Customer Service</h3>

            <ul>

                <li><a href="#">FAQs</a></li>

                <li><a href="#">Shipping Policy</a></li>

                <li><a href="#">Return Policy</a></li>

                <li><a href="#">Privacy Policy</a></li>

            </ul>

        </div>

        <!-- Column 4 -->

        <div class="footer-column">

            <h3>Contact Us</h3>

            <p><i class="fas fa-map-marker-alt"></i> Kathmandu, Nepal</p>

            <p><i class="fas fa-phone"></i> +977-98XXXXXXXX</p>

            <p><i class="fas fa-envelope"></i> support@fashionhub.com</p>

        </div>

    </div>

    <hr>

    <div class="footer-bottom">

        <p>
            © 2026 FashionHub. All Rights Reserved.
        </p>

    </div>

</footer>


</main>
