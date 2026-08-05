<!DOCTYPE html>
<html lang="en">

<head>

    <?php include("../includes/header.php"); ?>

</head>

<body>

<section class="auth-container">

    <div class="auth-box">

        <div class="auth-left">

            <img src="../assets/images/banners/login-banner.jpg" alt="FashionHub">

        </div>

        <div class="auth-right">

            <h2>Welcome Back</h2>

            <p>Login to continue shopping at FashionHub.</p>

            <form id="loginForm" action="../../backend/api/auth.php?action=login" method="POST">

                <div class="input-group">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        placeholder="Enter your email"
                        required>

                </div>

                <div class="input-group">

                    <label>Password</label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                        required>

                </div>

                <div class="remember">

                    <label>

                        <input type="checkbox">

                        Remember Me

                    </label>

                    <a href="#">Forgot Password?</a>

                </div>

                <button type="submit">

                    Login

                </button>

            </form>

            <div class="auth-footer">

                Don't have an account?

                <a href="register.php">

                    Register

                </a>

                <br><br>
                <a href="../admin/login.php">Login as Admin</a>

            </div>

        </div>

    </div>

</section>
<script src="/FashionHub/frontend/assets/js/app.js"></script>
<script src="/FashionHub/frontend/assets/js/cart.js"></script>
<script src="/FashionHub/frontend/assets/js/validation.js"></script>
</body>

</html>
