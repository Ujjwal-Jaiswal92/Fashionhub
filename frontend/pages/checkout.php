<?php
session_start();

if(!isset($_SESSION['user_id'])){
    die("Please login first.");
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Checkout</title>

<style>
body{
    font-family:Arial;
    width:70%;
    margin:40px auto;
}

button{
    padding:15px 30px;
    background:green;
    color:white;
    border:none;
    cursor:pointer;
    font-size:16px;
}
</style>

</head>

<body>

<h1>Checkout</h1>

<p>Click the button below to place your order.</p>

<form action="../../backend/api/orders.php?action=place" method="POST">

<button type="submit">

Place Order

</button>

</form>

</body>
</html>