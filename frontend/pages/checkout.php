<?php include("../includes/header.php"); ?>
<?php include("../includes/navbar.php"); ?>

<!-- ================= CHECKOUT ================= -->

<section class="checkout-page">

    <h2>Checkout</h2>

    <div class="checkout-container">

        <!-- Billing Details -->

        <div class="checkout-form">

            <h3>Billing Details</h3>

            <form action="#" method="POST">

                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" placeholder="Enter your full name" required>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" placeholder="98XXXXXXXX" required>
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <textarea rows="4" placeholder="Enter delivery address" required></textarea>
                </div>

                <div class="form-group">
                    <label>City</label>
                    <input type="text" placeholder="Kathmandu" required>
                </div>

                <div class="form-group">
                    <label>Payment Method</label>

                    <div class="payment-method">
                        <label>
                            <input type="radio" name="payment" checked>
                            Cash on Delivery
                        </label>

                        <label>
                            <input type="radio" name="payment">
                            Khalti
                        </label>
                    </div>
                </div>

            </form>

        </div>

        <!-- Order Summary -->

        <div class="order-summary">

            <h3>Order Summary</h3>

            <div class="summary-row">
                <span>Classic Shirt × 1</span>
                <span>Rs. 2,499</span>
            </div>

            <div class="summary-row">
                <span>Shipping</span>
                <span>Free</span>
            </div>

            <hr>

            <div class="summary-row total">
                <span>Total</span>
                <span>Rs. 2,499</span>
            </div>

            <button class="place-order-btn">
                Place Order
            </button>

        </div>

    </div>

</section>

<?php include("../includes/footer.php"); ?>