<?php include("../includes/header.php"); ?>
<?php include("../includes/navbar.php"); ?>

<section class="change-password">

    <div class="password-card">

        <h2>Change Password</h2>

        <p>Keep your FashionHub account secure by updating your password.</p>

        <form action="#" method="POST">

            <div class="form-group">

                <label>Current Password</label>

                <input type="password" placeholder="Enter current password" required>

            </div>

            <div class="form-group">

                <label>New Password</label>

                <input type="password" placeholder="Enter new password" required>

            </div>

            <div class="form-group">

                <label>Confirm New Password</label>

                <input type="password" placeholder="Confirm new password" required>

            </div>

            <button type="submit">

                Update Password

            </button>

        </form>

    </div>

</section>

<?php include("../includes/footer.php"); ?>