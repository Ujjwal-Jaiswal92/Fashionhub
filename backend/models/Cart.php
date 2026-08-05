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
    // Get Cart Items
public function getCartItems($user_id)
{
    $query = "
        SELECT
            ci.cart_item_id,
            ci.quantity,
            p.product_id,
            p.product_name,
            p.price,
            p.image,
            p.stock
        FROM cart c
        INNER JOIN cart_items ci
            ON c.cart_id = ci.cart_id
        INNER JOIN products p
            ON ci.product_id = p.product_id
        WHERE c.user_id = :user
        ORDER BY ci.cart_item_id DESC
    ";

    $stmt = $this->conn->prepare($query);

    $stmt->execute([
        ':user' => $user_id
    ]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get Cart ID
public function getCartId($user_id)
{
    $stmt = $this->conn->prepare("
        SELECT cart_id
        FROM cart
        WHERE user_id=?
    ");

    $stmt->execute([$user_id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Get Cart Total
public function getTotal($user_id)
{
    $stmt = $this->conn->prepare("
        SELECT
        SUM(ci.quantity*p.price) AS total
        FROM cart c
        JOIN cart_items ci
            ON c.cart_id=ci.cart_id
        JOIN products p
            ON ci.product_id=p.product_id
        WHERE c.user_id=?
    ");

    $stmt->execute([$user_id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
}