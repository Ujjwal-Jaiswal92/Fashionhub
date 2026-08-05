<?php

require_once __DIR__ . '/../config/database.php';

class Cart
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Get user's cart
    public function getCart($user_id)
    {
        $stmt = $this->conn->prepare("
            SELECT *
            FROM cart
            WHERE user_id=?
            LIMIT 1
        ");

        $stmt->execute([$user_id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create cart
    public function createCart($user_id)
    {
        $stmt = $this->conn->prepare("
            INSERT INTO cart(user_id)
            VALUES(?)
        ");

        $stmt->execute([$user_id]);

        return $this->conn->lastInsertId();
    }

    // Add product
    public function addItem($cart_id,$product_id,$qty)
    {
        // Already exists?
        $stmt = $this->conn->prepare("
            SELECT *
            FROM cart_items
            WHERE cart_id=?
            AND product_id=?
        ");

        $stmt->execute([$cart_id,$product_id]);

        $item=$stmt->fetch(PDO::FETCH_ASSOC);

        if($item)
        {
            $stmt=$this->conn->prepare("
                UPDATE cart_items
                SET quantity=quantity+?
                WHERE cart_item_id=?
            ");

            return $stmt->execute([
                $qty,
                $item['cart_item_id']
            ]);
        }

        $stmt=$this->conn->prepare("
            INSERT INTO cart_items
            (
                cart_id,
                product_id,
                quantity
            )
            VALUES(?,?,?)
        ");

        return $stmt->execute([
            $cart_id,
            $product_id,
            $qty
        ]);
    }
}