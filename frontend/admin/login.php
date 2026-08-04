<!DOCTYPE html>
<html lang="en">

<head>

<?php include("../includes/header.php"); ?>

</head>

<body>

<section class="admin-login">

    <div class="admin-login-box">

        <div class="admin-logo">

            <h1>FashionHub</h1>

            <p>Admin Panel</p>

        </div>

        <form action="../../backend/api/auth/admin-login.php" method="POST">

            <div class="input-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    placeholder="admin@fashionhub.com"
                    required>

            </div>

            <div class="input-group">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Enter password"
                    required>

            </div>

            <button type="submit">

                Login

            </button>

        </form>

    </div>

</section>

</body>

</html>
