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
        $this->order->createPaymentRecord($order_id, $total, $payment_method);

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

        if ($payment_method === 'Khalti') {
            $configFile = __DIR__ . '/../config/khalti.php';
            if (!is_file($configFile)) { header('Location: ../../frontend/pages/checkout.php?error=khalti'); exit(); }
            $config = require $configFile;
            if (empty($config['secret_key']) || $config['secret_key'] === 'YOUR_KHALTI_SECRET_KEY') { header('Location: ../../frontend/pages/checkout.php?error=khalti'); exit(); }
            $payload = [
                'return_url' => ($config['website_url'] ?? 'http://localhost/FashionHub') . '/backend/api/orders.php?action=khalti-return',
                'website_url' => $config['website_url'] ?? 'http://localhost/FashionHub',
                'amount' => (int)round($total * 100),
                'purchase_order_id' => 'FH-' . $order_id,
                'purchase_order_name' => 'FashionHub Order #' . $order_id,
            ];
            $curl = curl_init(rtrim($config['base_url'], '/') . '/epayment/initiate/');
            curl_setopt_array($curl, [CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true, CURLOPT_POSTFIELDS => json_encode($payload), CURLOPT_HTTPHEADER => ['Authorization: Key ' . $config['secret_key'], 'Content-Type: application/json']]);
            $response = json_decode(curl_exec($curl), true);
            curl_close($curl);
            if (empty($response['payment_url']) || empty($response['pidx'])) { header('Location: ../../frontend/pages/checkout.php?error=khalti'); exit(); }
            $this->order->setPaymentReference($order_id, $response['pidx']);
            header('Location: ' . $response['payment_url']); exit();
        }

        header("Location: ../../frontend/pages/order-success.php");
        exit();
    }

    public function khaltiReturn()
    {
        $pidx = $_GET['pidx'] ?? '';
        $configFile = __DIR__ . '/../config/khalti.php';
        if (!$pidx || !is_file($configFile)) { header('Location: ../../frontend/pages/checkout.php?error=khalti'); exit(); }
        $config = require $configFile;
        $order = $this->order->getByPaymentReference($pidx);
        if (!$order) { header('Location: ../../frontend/pages/checkout.php?error=khalti'); exit(); }
        $curl = curl_init(rtrim($config['base_url'], '/') . '/epayment/lookup/');
        curl_setopt_array($curl, [CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => true, CURLOPT_POSTFIELDS => json_encode(['pidx' => $pidx]), CURLOPT_HTTPHEADER => ['Authorization: Key ' . $config['secret_key'], 'Content-Type: application/json']]);
        $result = json_decode(curl_exec($curl), true); curl_close($curl);
        if (($result['status'] ?? '') === 'Completed' && (int)($result['total_amount'] ?? 0) === (int)round($order['total_amount'] * 100)) {
            $this->order->confirmKhaltiPayment($order['order_id'], $order['payment_id'], $result['transaction_id'] ?? $pidx);
            header('Location: ../../frontend/pages/order-success.php'); exit();
        }
        header('Location: ../../frontend/pages/checkout.php?error=khalti'); exit();
    }

    public function getMyOrders()
    {
        if (!isset($_SESSION['user_id'])) { return []; }
        return $this->order->getByUser($_SESSION['user_id']);
    }

    public function updateOrderStatus()
    {
        if (($_SESSION['role'] ?? '') !== 'admin') { header('Location: ../../frontend/admin/login.php'); exit(); }
        $success = $this->order->updateStatus((int)($_POST['order_id'] ?? 0), $_POST['order_status'] ?? '', $_POST['payment_status'] ?? '');
        header('Location: ../../frontend/admin/orders.php?' . ($success ? 'success=1' : 'error=1'));
        exit();
    }
}
