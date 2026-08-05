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
    public function createOrder($user_id, $total_amount)
    {
        $stmt = $this->conn->prepare("
            INSERT INTO orders
            (user_id,total_amount,status)
            VALUES
            (?,?,'Pending')
        ");

        $stmt->execute([
            $user_id,
            $total_amount
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
}