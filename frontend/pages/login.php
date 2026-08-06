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

            <?php if (($_GET['notice'] ?? '') === 'cart'): ?>
                <p class="login-notice">Please log in to add items to your cart.</p>
            <?php endif; ?>
            <?php if (($_GET['notice'] ?? '') === 'registered'): ?><p class="login-notice">Registration successful. You can now log in.</p><?php endif; ?>
            <?php if (($_GET['notice'] ?? '') === 'seller-pending'): ?><p class="login-notice">Seller registration received. An administrator must approve your seller account before you can log in.</p><?php endif; ?>
            <?php if (($_GET['notice'] ?? '') === 'verified'): ?><p class="login-notice">Your email has been verified. You can now log in.</p><?php endif; ?>
            <?php if (($_GET['notice'] ?? '') === 'reset'): ?><p class="login-notice">If that email exists, a password-reset link has been sent.</p><?php endif; ?>
            <?php if (($_GET['notice'] ?? '') === 'password-reset'): ?><p class="login-notice">Password updated. You can now log in.</p><?php endif; ?>
            <?php if (isset($_GET['error'])): ?><p class="login-notice">Login failed. Check your credentials and selected account type.</p><?php endif; ?>

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
                    <label>Login as</label>
                    <select name="login_as" required>
                        <option value="customer">Customer</option>
                        <option value="seller">Seller</option>
                    </select>
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

                        <input type="checkbox" name="remember_me" value="1">

                        Remember Me

                    </label>

                    <a href="forgot-password.php">Forgot Password?</a>

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
