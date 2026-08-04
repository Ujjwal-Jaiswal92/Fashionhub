<?php include("../includes/header.php"); ?>
<?php include("../includes/navbar.php"); ?>

<section class="orders-page">

    <div class="section-title">
        <h2>My Orders</h2>
        <p>Track all your recent purchases.</p>
    </div>

    <div class="orders-table">

        <table>

            <thead>

                <tr>

                    <th>Order ID</th>

                    <th>Date</th>

                    <th>Items</th>

                    <th>Total</th>

                    <th>Status</th>

                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>#FH1001</td>

                    <td>04 Aug 2026</td>

                    <td>Classic Shirt × 1</td>

                    <td>Rs. 2,499</td>

                    <td>
                        <span class="status delivered">
                            Delivered
                        </span>
                    </td>

                    <td>

                        <a href="product-details.php" class="view-btn">
                            View
                        </a>

                    </td>

                </tr>

                <tr>

                    <td>#FH1002</td>

                    <td>01 Aug 2026</td>

                    <td>Kids Jacket × 2</td>

                    <td>Rs. 4,398</td>

                    <td>
                        <span class="status shipped">
                            Shipped
                        </span>
                    </td>

                    <td>

                        <a href="#" class="view-btn">
                            Track
                        </a>

                    </td>

                </tr>

                <tr>

                    <td>#FH1003</td>

                    <td>28 Jul 2026</td>

                    <td>Summer Dress × 1</td>

                    <td>Rs. 2,999</td>

                    <td>
                        <span class="status pending">
                            Pending
                        </span>
                    </td>

                    <td>

                        <a href="#" class="view-btn">
                            Details
                        </a>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</section>

<?php include("../includes/footer.php"); ?>