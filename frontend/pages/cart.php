<?php include("../includes/header.php"); ?>
<?php include("../includes/navbar.php"); ?>

<!-- ================= CART ================= -->

<section class="cart-page">

    <h2>Your Shopping Cart</h2>

    <div class="cart-container">

        <!-- Left -->

        <div class="cart-items">

            <table>

                <thead>

                    <tr>

                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>

                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td class="product-info">

                            <img src="../assets/images/products/product1.jpg">

                            <div>

                                <h4>Classic Shirt</h4>

                                <p>Size : M</p>

                            </div>

                        </td>

                        <td>Rs. 2,499</td>

                        <td>

                            <input type="number" value="1" min="1">

                        </td>

                        <td>Rs. 2,499</td>

                        <td>

                            <button class="remove-btn">

                                <i class="fas fa-trash"></i>

                            </button>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

        <!-- Right -->

        <div class="cart-summary">

            <h3>Cart Summary</h3>

            <div class="summary-item">

                <span>Subtotal</span>

                <span>Rs. 2,499</span>

            </div>

            <div class="summary-item">

                <span>Shipping</span>

                <span>Free</span>

            </div>

            <hr>

            <div class="summary-item total">

                <span>Total</span>

                <span>Rs. 2,499</span>

            </div>

            <a href="checkout.php" class="checkout-btn">

                Proceed to Checkout

            </a>

        </div>

    </div>

</section>

<?php include("../includes/footer.php"); ?>
