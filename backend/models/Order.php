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
}
