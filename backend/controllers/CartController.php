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
            die("Please login first.");
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
}