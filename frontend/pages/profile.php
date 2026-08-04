<?php include("../includes/header.php"); ?>
<?php include("../includes/navbar.php"); ?>

<!-- ================= PROFILE ================= -->

<section class="profile-page">

    <div class="profile-container">

        <!-- Sidebar -->

        <aside class="profile-sidebar">

            <img src="../assets/images/users/user1.jpg" alt="User">

            <h3>Srijana Uranw</h3>

            <p>Customer</p>

            <ul>

                <li class="active"><a href="#">My Profile</a></li>

                <li><a href="#">My Orders</a></li>

                <li><a href="#">Wishlist</a></li>

                <li><a href="#">Change Password</a></li>

                <li><a href="#">Logout</a></li>

            </ul>

        </aside>

        <!-- Profile Content -->

        <div class="profile-content">

            <h2>My Profile</h2>

            <form>

                <div class="profile-row">

                    <div class="profile-input">

                        <label>Full Name</label>

                        <input type="text" value="Srijana Uranw">

                    </div>

                    <div class="profile-input">

                        <label>Email</label>

                        <input type="email" value="srijana@gmail.com">

                    </div>

                </div>

                <div class="profile-row">

                    <div class="profile-input">

                        <label>Phone Number</label>

                        <input type="text" value="98XXXXXXXX">

                    </div>

                    <div class="profile-input">

                        <label>City</label>

                        <input type="text" value="Kathmandu">

                    </div>

                </div>

                <div class="profile-input">

                    <label>Address</label>

                    <textarea rows="5">Kathmandu, Nepal</textarea>

                </div>

                <button class="save-btn">

                    Update Profile

                </button>

            </form>

        </div>

    </div>

</section>

<?php include("../includes/footer.php"); ?>