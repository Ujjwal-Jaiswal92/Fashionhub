<?php

require_once __DIR__ . '/../models/Cart.php';

class CartController
{
    private $cart;

    public function __construct()
    {
        $this->cart = new Cart();
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            die("Invalid Request");
        }

        if (!isset($_SESSION['user_id'])) {
            $this->redirectToLogin();
        }

        $user_id = $_SESSION['user_id'];
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        // Check if user already has a cart
        $cart = $this->cart->getCart($user_id);

        if (!$cart) {
            $cart_id = $this->cart->createCart($user_id);
        } else {
            $cart_id = $cart['cart_id'];
        }

        $this->cart->addItem($cart_id, $product_id, $quantity);

        header("Location: ../../frontend/pages/cart.php");
        exit();
    }
    public function remove()
    {
        if (!isset($_SESSION['user_id'])) { $this->redirectToLogin(); }
        $itemId = (int)($_POST['cart_item_id'] ?? 0);
        $database = new Database();
        $conn = $database->connect();
        $stmt = $conn->prepare('DELETE ci FROM cart_items ci INNER JOIN cart c ON c.cart_id = ci.cart_id WHERE ci.cart_item_id = ? AND c.user_id = ?');
        $stmt->execute([$itemId, $_SESSION['user_id']]);
        header('Location: ../../frontend/pages/cart.php');
        exit();
    }
    public function getCartItems()
{
    if (session_status() === PHP_SESSION_NONE) { session_start(); }
    if (!isset($_SESSION['user_id'])) {
        return [];
    }

    return $this->cart->getCartItems($_SESSION['user_id']);
}

    private function redirectToLogin()
    {
        if (session_status() === PHP_SESSION_NONE) { session_start(); }
        $referrer = $_SERVER['HTTP_REFERER'] ?? '';
        $path = parse_url($referrer, PHP_URL_PATH) ?: '';
        if (str_starts_with($path, '/FashionHub/frontend/pages/')) {
            $_SESSION['post_login_redirect'] = $path;
        }
        header('Location: ../../frontend/pages/login.php?notice=cart');
        exit();
    }
}
