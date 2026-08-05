<?php
session_start();
require_once '../../backend/controllers/CartController.php';
$cartItems = (new CartController())->getCartItems();
$cartTotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cartItems));
include("../includes/header.php");
?>
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
                    <?php foreach ($cartItems as $item): ?>
                    <tr>
                        <td class="product-info"><img src="../../uploads/products/<?= htmlspecialchars($item['image'] ?: 'placeholder.png') ?>"><div><h4><?= htmlspecialchars($item['product_name']) ?></h4></div></td>
                        <td>Rs. <?= number_format((float)$item['price'], 2) ?></td>
                        <td><?= (int)$item['quantity'] ?></td>
                        <td>Rs. <?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                        <td><form action="../../backend/api/cart.php?action=remove" method="POST"><input type="hidden" name="cart_item_id" value="<?= (int)$item['cart_item_id'] ?>"><button class="remove-btn" type="submit"><i class="fas fa-trash"></i></button></form></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (!$cartItems): ?><tr><td colspan="5">Your cart is empty. <a href="products.php">Browse products</a></td></tr><?php endif; ?>
                    <?php if (false): ?>
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
                    <?php endif; ?>

                </tbody>

            </table>

        </div>

        <!-- Right -->

        <div class="cart-summary">

            <h3>Cart Summary</h3>

            <div class="summary-item">

                <span>Subtotal</span>

                <span>Rs. <?= number_format($cartTotal, 2) ?></span>

            </div>

            <div class="summary-item">

                <span>Shipping</span>

                <span>Free</span>

            </div>

            <hr>

            <div class="summary-item total">

                <span>Total</span>

                <span>Rs. <?= number_format($cartTotal, 2) ?></span>

            </div>

            <a href="<?= $cartItems ? 'checkout.php' : 'products.php' ?>" class="checkout-btn">

                Proceed to Checkout

            </a>

        </div>

    </div>

</section>

<?php include("../includes/footer.php"); ?>
