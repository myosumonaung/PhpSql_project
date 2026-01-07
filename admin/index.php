<?php include("widget/header.php"); ?>


    <!-- Dashboard -->
    <div class="container">
        <div class="row pt-4 pb-4 text-color gt-3">
            <?php 
                if (isset($_SESSION['noti'])) {
                    echo $_SESSION['noti'];
                    unset($_SESSION['noti']);
                }
            ?>

            <h2 class="mt-4 mb-5">Dashboard</h2>

            <div class="col-3">
                <div class="border pt-5 pb-5 bg-body rounded-3 shadow-sm text-center">
                    <?php 
                        $sql = "SELECT * FROM categories";
                        $result = mysqli_query($conn,$sql);

                        $count = mysqli_num_rows($result);
                    ?>
                    <h4><?= $count ?></h4>
                    <h4>Categories</h4>
                </div>
            </div>
            <div class="col-3">
                <div class="border pt-5 pb-5 bg-body rounded-3 shadow-sm text-center">
                    <?php 
                        $sql = "SELECT * FROM products";
                        $result = mysqli_query($conn,$sql);

                        $count = mysqli_num_rows($result);
                    ?>
                    <h4><?= $count ?></h4>
                    <h4>Products</h4>
                </div>
            </div>
            <div class="col-3">
                <div class="border pt-5 pb-5 bg-body rounded-3 shadow-sm text-center">
                    <?php 
                        $sql = "SELECT * FROM orders";
                        $result = mysqli_query($conn,$sql);

                        $count = mysqli_num_rows($result);
                    ?>
                    <h4><?= $count ?></h4>
                    <h4>Total Orders</h4>
                </div>
            </div>
            <div class="col-3">
                <div class="border pt-5 pb-5 bg-body rounded-3 shadow-sm text-center">
                    <?php 
                        $sql = "SELECT * FROM orders WHERE status = 'Delivered'";
                        $result = mysqli_query($conn,$sql);

                        $total = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $total += $row['total'];
                        }
                    ?>
                    <h4>$ <?= $total ?></h4>
                    <h4>Revenue Generated</h4>
                </div>
            </div>

        </div>
    </div>
    <!-- Dashborad -->

<?php include("widget/footer.php"); ?>