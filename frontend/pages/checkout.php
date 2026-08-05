<?php
session_start();
require_once '../../backend/controllers/CartController.php';
$checkoutItems = (new CartController())->getCartItems();
$checkoutTotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $checkoutItems));
if (!$checkoutItems) { header('Location: products.php'); exit; }
include("../includes/header.php");
?>
<?php include("../includes/navbar.php"); ?>

<!-- ================= CHECKOUT ================= -->

<section class="checkout-page">

    <h2>Checkout</h2>

    <div class="checkout-container">

        <!-- Billing Details -->

        <div class="checkout-form">

            <h3>Billing Details</h3>

            <form id="checkout-form" action="../../backend/api/orders.php?action=place" method="POST">

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
                    <textarea name="shipping_address" rows="4" placeholder="Enter delivery address" required></textarea>
                </div>

                <div class="form-group">
                    <label>City</label>
                    <input type="text" placeholder="Kathmandu" required>
                </div>

                <div class="form-group">
                    <label>Payment Method</label>

                    <div class="payment-method">
                        <label>
                            <input type="radio" name="payment_method" value="Cash on Delivery" checked>
                            Cash on Delivery
                        </label>

                        <label>
                            <input type="radio" name="payment_method" value="Khalti">
                            Khalti
                        </label>
                    </div>
                </div>

            </form>

        </div>

        <!-- Order Summary -->

        <div class="order-summary">

            <h3>Order Summary</h3>

            <?php foreach ($checkoutItems as $item): ?><div class="summary-row"><span><?= htmlspecialchars($item['product_name']) ?> × <?= (int)$item['quantity'] ?></span><span>Rs. <?= number_format($item['price'] * $item['quantity'], 2) ?></span></div><?php endforeach; ?>

            <div class="summary-row">
                <span>Shipping</span>
                <span>Free</span>
            </div>

            <hr>

            <div class="summary-row total">
                <span>Total</span>
                <span>Rs. <?= number_format($checkoutTotal, 2) ?></span>
            </div>

            <button class="place-order-btn" form="checkout-form" type="submit">
                Place Order
            </button>

        </div>

    </div>

</section>

<?php include("../includes/footer.php"); ?>
