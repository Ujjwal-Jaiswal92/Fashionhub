<?php

require_once __DIR__ . '/../config/database.php';

class Order
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Create Order
    public function createOrder($user_id, $total_amount, $payment_method, $shipping_address)
    {
        $stmt = $this->conn->prepare("
            INSERT INTO orders
            (user_id,total_amount,payment_method,payment_status,order_status,shipping_address)
            VALUES
            (?, ?, ?, 'Pending', 'Pending', ?)
        ");

        $stmt->execute([
            $user_id,
            $total_amount,
            $payment_method,
            $shipping_address
        ]);

        return $this->conn->lastInsertId();
    }

    // Add Order Item
    public function addOrderItem($order_id,$product_id,$price,$quantity)
    {
        $stmt = $this->conn->prepare("
            INSERT INTO order_items
            (
                order_id,
                product_id,
                price,
                quantity
            )
            VALUES(?,?,?,?)
        ");

        return $stmt->execute([
            $order_id,
            $product_id,
            $price,
            $quantity
        ]);
    }

    // Reduce Product Stock
    public function reduceStock($product_id,$qty)
    {
        $stmt = $this->conn->prepare("
            UPDATE products
            SET stock = stock - ?
            WHERE product_id=?
        ");

        return $stmt->execute([
            $qty,
            $product_id
        ]);
    }

    // Empty Cart
    public function clearCart($cart_id)
    {
        $stmt = $this->conn->prepare("
            DELETE FROM cart_items
            WHERE cart_id=?
        ");

        return $stmt->execute([$cart_id]);
    }

    public function getByUser($userId)
    {
        $stmt = $this->conn->prepare('SELECT o.*, GROUP_CONCAT(CONCAT(p.product_name, " × ", oi.quantity) SEPARATOR ", ") AS items FROM orders o LEFT JOIN order_items oi ON oi.order_id = o.order_id LEFT JOIN products p ON p.product_id = oi.product_id WHERE o.user_id = ? GROUP BY o.order_id ORDER BY o.created_at DESC');
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($orderId, $orderStatus, $paymentStatus)
    {
        $allowedOrders = ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'];
        $allowedPayments = ['Pending', 'Paid', 'Failed'];
        if (!in_array($orderStatus, $allowedOrders, true) || !in_array($paymentStatus, $allowedPayments, true)) { return false; }
        $stmt = $this->conn->prepare('UPDATE orders SET order_status = ?, payment_status = ? WHERE order_id = ?');
        return $stmt->execute([$orderStatus, $paymentStatus, $orderId]);
    }

    public function createPaymentRecord($orderId, $amount, $method)
    {
        $stmt = $this->conn->prepare("INSERT INTO payments (order_id, amount, payment_method, payment_status) VALUES (?, ?, ?, 'Pending')");
        return $stmt->execute([$orderId, $amount, $method]);
    }

    public function setPaymentReference($orderId, $reference)
    {
        return $this->conn->prepare('UPDATE payments SET transaction_id = ? WHERE order_id = ?')->execute([$reference, $orderId]);
    }

    public function getByPaymentReference($reference)
    {
        $stmt = $this->conn->prepare('SELECT o.*, p.payment_id FROM orders o JOIN payments p ON p.order_id = o.order_id WHERE p.transaction_id = ? LIMIT 1');
        $stmt->execute([$reference]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function confirmEsewaPayment($orderId, $paymentId, $transactionId)
    {
        $this->conn->prepare("UPDATE orders SET payment_status = 'Paid', order_status = 'Processing' WHERE order_id = ?")->execute([$orderId]);
        return $this->conn->prepare("UPDATE payments SET transaction_id = ?, payment_status = 'Completed', paid_at = NOW() WHERE payment_id = ?")->execute([$transactionId, $paymentId]);
    }
}
