<?php

require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../models/Cart.php';

class OrderController
{
    private $order;
    private $cart;

    public function __construct()
    {
        $this->order = new Order();
        $this->cart = new Cart();
    }

    public function placeOrder()
    {
        if (!isset($_SESSION['user_id'])) {
            die("Please login first.");
        }

        $user_id = $_SESSION['user_id'];

        // Get cart
        $cart = $this->cart->getCart($user_id);

        if (!$cart) {
            die("Cart not found.");
        }

        $cart_id = $cart['cart_id'];

        // Get cart items
        $items = $this->cart->getCartItems($user_id);

        if (count($items) == 0) {
            die("Your cart is empty.");
        }

        // Calculate total
        $total = 0;

        foreach ($items as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $payment_method = $_POST['payment_method'] ?? 'Cash on Delivery';
        $shipping_address = trim($_POST['shipping_address'] ?? '');
        if (!in_array($payment_method, ['Cash on Delivery', 'Khalti'], true) || $shipping_address === '') {
            die('Please provide a delivery address and valid payment method.');
        }

        // Create order. The schema uses order_status and payment_status, not a status column.
        $order_id = $this->order->createOrder($user_id, $total, $payment_method, $shipping_address);

        // Add order items
        foreach ($items as $item) {

            $this->order->addOrderItem(
                $order_id,
                $item['product_id'],
                $item['price'],
                $item['quantity']
            );

            $this->order->reduceStock(
                $item['product_id'],
                $item['quantity']
            );
        }

        // Clear cart
        $this->order->clearCart($cart_id);

        header("Location: ../../frontend/pages/order-success.php");
        exit();
    }
}
