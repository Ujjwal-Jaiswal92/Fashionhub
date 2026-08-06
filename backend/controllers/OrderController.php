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
        if (!in_array($payment_method, ['Cash on Delivery', 'eSewa'], true) || $shipping_address === '') {
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

        if ($payment_method === 'eSewa') {
            $configFile = __DIR__ . '/../config/esewa.php';
            if (!is_file($configFile)) { header('Location: ../../frontend/pages/checkout.php?error=esewa'); exit(); }
            $config = require $configFile;
            if (empty($config['product_code']) || empty($config['secret_key'])) { header('Location: ../../frontend/pages/checkout.php?error=esewa'); exit(); }

            $transactionUuid = 'FH-' . $order_id . '-' . bin2hex(random_bytes(6));
            $this->order->setPaymentReference($order_id, $transactionUuid);
            $amount = number_format((float)$total, 2, '.', '');
            $signedFields = 'total_amount,transaction_uuid,product_code';
            $signatureMessage = "total_amount={$amount},transaction_uuid={$transactionUuid},product_code={$config['product_code']}";
            $signature = base64_encode(hash_hmac('sha256', $signatureMessage, $config['secret_key'], true));
            $websiteUrl = rtrim($config['website_url'] ?? 'http://localhost/FashionHub', '/');
            $fields = [
                'amount' => $amount,
                'tax_amount' => '0',
                'total_amount' => $amount,
                'transaction_uuid' => $transactionUuid,
                'product_code' => $config['product_code'],
                'product_service_charge' => '0',
                'product_delivery_charge' => '0',
                // eSewa appends ?data=... to the success URL, so this must be
                // a dedicated endpoint without an existing query string.
                'success_url' => $websiteUrl . '/backend/api/esewa-return.php',
                'failure_url' => $websiteUrl . '/backend/api/esewa-return.php?failed=1',
                'signed_field_names' => $signedFields,
                'signature' => $signature,
            ];
            $this->renderEsewaForm($config['form_url'], $fields);
        }

        header("Location: ../../frontend/pages/order-success.php");
        exit();
    }

    public function esewaReturn()
    {
        $configFile = __DIR__ . '/../config/esewa.php';
        if (isset($_GET['failed']) || !is_file($configFile)) { header('Location: ../../frontend/pages/checkout.php?error=esewa'); exit(); }
        $config = require $configFile;
        $encodedData = $_GET['data'] ?? '';
        $data = json_decode(base64_decode($encodedData, true) ?: '', true);
        $transactionUuid = $data['transaction_uuid'] ?? '';
        $order = $transactionUuid ? $this->order->getByPaymentReference($transactionUuid) : false;
        if (!$order || ($data['status'] ?? '') !== 'COMPLETE') { header('Location: ../../frontend/pages/checkout.php?error=esewa'); exit(); }

        $query = http_build_query([
            'product_code' => $config['product_code'],
            'total_amount' => number_format((float)$order['total_amount'], 2, '.', ''),
            'transaction_uuid' => $transactionUuid,
        ]);
        $curl = curl_init(rtrim($config['status_url'], '?') . '?' . $query);
        curl_setopt_array($curl, [CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 15]);
        $result = json_decode(curl_exec($curl), true); curl_close($curl);
        if (($result['status'] ?? '') === 'COMPLETE' && (float)($result['total_amount'] ?? -1) === (float)$order['total_amount']) {
            $this->order->confirmEsewaPayment($order['order_id'], $order['payment_id'], $data['transaction_code'] ?? $transactionUuid);
            header('Location: ../../frontend/pages/order-success.php'); exit();
        }
        header('Location: ../../frontend/pages/checkout.php?error=esewa'); exit();
    }

    private function renderEsewaForm($action, array $fields)
    {
        header('Content-Type: text/html; charset=UTF-8');
        echo '<!doctype html><html><head><meta charset="utf-8"><title>Redirecting to eSewa</title>';
        echo '<style>body{font-family:Arial,sans-serif;background:#f5f7fb;display:grid;place-items:center;min-height:100vh;margin:0}.box{background:#fff;padding:36px;border-radius:14px;box-shadow:0 8px 24px #0002;text-align:center}button{background:#60bb46;color:#fff;border:0;border-radius:7px;padding:12px 20px;font-size:16px}</style>';
        echo '</head><body><div class="box"><h2>Redirecting to eSewa</h2><p>Please wait while we open the secure sandbox payment page.</p><form id="esewa-form" method="POST" action="' . htmlspecialchars($action, ENT_QUOTES, 'UTF-8') . '">';
        foreach ($fields as $name => $value) { echo '<input type="hidden" name="' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '" value="' . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . '">'; }
        echo '<button type="submit">Continue to eSewa</button></form><script>document.getElementById("esewa-form").submit();</script></div></body></html>';
        exit();
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
