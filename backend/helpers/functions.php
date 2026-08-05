<?php

function redirect($url)
{
    header("Location: " . $url);
    exit();
}

function sanitize($data)
{
    return htmlspecialchars(trim($data));
}

function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

function isAdmin()
{
    return isset($_SESSION['role']) &&
           $_SESSION['role'] === 'admin';
}

function isSeller()
{
    return isset($_SESSION['role']) &&
           $_SESSION['role'] === 'seller';
}

function isCustomer()
{
    return isset($_SESSION['role']) &&
           $_SESSION['role'] === 'customer';
}

?>