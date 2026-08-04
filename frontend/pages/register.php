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

            <form action="../../backend/api/auth/register.php" method="POST">

                <div class="input-group">
                    <label>Full Name</label>
                    <input
                        type="text"
                        name="fullname"
                        placeholder="Enter your full name"
                        required>
                </div>

                <div class="input-group">
                    <label>Email</label>
                    <input
                        type="email"
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
                        name="password"
                        placeholder="Create password"
                        required>
                </div>

                <div class="input-group">
                    <label>Confirm Password</label>
                    <input
                        type="password"
                        name="confirm_password"
                        placeholder="Confirm password"
                        required>
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

            </div>

        </div>

    </div>

</section>

</body>

</html>