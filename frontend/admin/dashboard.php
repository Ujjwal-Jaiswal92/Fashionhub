<?php

require_once "../../backend/middleware/admin.php";

?>

<!DOCTYPE html>

<html>

<head>

<title>Admin Dashboard</title>

</head>

<body>

<h1>Admin Dashboard</h1>

<h2>
Welcome,
<?php echo $_SESSION['full_name']; ?>
</h2>

<a href="../../backend/api/auth.php?action=logout">
Logout
</a>

</body>

</html>