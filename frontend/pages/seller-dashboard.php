<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Seller Dashboard</title>
</head>

<body>

<h1>Welcome Seller</h1>

<p>Hello,
<strong>
<?php echo $_SESSION['full_name']; ?>
</strong>
</p>

<a href="../../backend/api/auth.php?action=logout">
Logout
</a>

</body>
</html>