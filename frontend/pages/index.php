<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>FashionHub</title>
</head>

<body>

<h1>FashionHub</h1>

<?php if(isset($_SESSION['user_id'])): ?>

<h3>
Welcome
<?php echo $_SESSION['full_name']; ?>
</h3>

<p>
Role :
<?php echo $_SESSION['role']; ?>
</p>

<a href="../../backend/api/auth.php?action=logout">
Logout
</a>

<?php else: ?>

<a href="login.php">Login</a>

|

<a href="register.php">Register</a>

<?php endif; ?>

</body>

</html>