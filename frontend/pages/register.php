<!DOCTYPE html>
<html lang="en">

<head>

    <?php include("../includes/header.php"); ?>

</head>

<body>

<section class="auth-container">

    <div class="auth-box">

        <!-- Left Side -->

        <div class="auth-left">

            <img src="../assets/images/banners/register-banner.jpg" alt="Register">

        </div>

        <!-- Right Side -->

        <div class="auth-right">

            <h2>Create Account</h2>

            <p>Join FashionHub and start shopping today.</p>

            <form id="registerForm" action="../../backend/api/auth.php?action=register" method="POST">

                <div class="input-group">
                    <label>Full Name</label>
                    <input
                        type="text"
                        id="name"
                        name="full_name"
                        placeholder="Enter your full name"
                        required>
                </div>

                <div class="input-group">
                    <label>Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Enter your email"
                        required>
                </div>

                <div class="input-group">
                    <label>Phone Number</label>
                    <input
                        type="text"
                        name="phone"
                        placeholder="98XXXXXXXX"
                        required>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Create password"
                        required>
                </div>

                <div class="input-group">
                    <label>Confirm Password</label>
                    <input
                        type="password"
                        id="confirmPassword"
                        name="confirm_password"
                        placeholder="Confirm password"
                        required>
                </div>

                <div class="input-group">
                    <label>Account type</label>
                    <select name="role" required>
                        <option value="customer">Customer</option>
                        <option value="seller">Seller</option>
                    </select>
                </div>

                <div class="remember">

                    <label>

                        <input type="checkbox" required>

                        I agree to the Terms & Conditions

                    </label>

                </div>

                <button type="submit">

                    Create Account

                </button>

            </form>

            <div class="auth-footer">

                Already have an account?

                <a href="login.php">

                    Login

                </a>
                <br><br>
                <a href="../admin/login.php">Login as Admin</a>

            </div>

        </div>

    </div>

</section>

</body>

</html>
