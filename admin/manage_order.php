<?php include("widget/header.php"); ?>

    <div class="container">
        <div class="row pt-4 pb-4 text-color">
            <?php 
                if (isset($_SESSION['noti'])) {
                    echo $_SESSION['noti'];
                    unset($_SESSION['noti']);
                }            
            ?>

            <h2 class="mt-4 mb-3">Manage Product</h2>
            <div class="col-12">
                <a href="add_product.php" class="btn btn-primary w-10 mb-3">Manage Order</a>

                <table class="table table-light table-striped">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Total</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Name</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql = "SELECT * FROM orders";
                            $result = mysqli_query($conn,$sql);

                            $count = mysqli_num_rows($result);

                            if ($count == 0) {
                                echo "No Data";
                            }else{
                                $sn = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['id'];
                                    $product = $row['product'];
                                    $price = $row['price'];
                                    $qty = $row['qty'];
                                    $total = $row['total'];
                                    $order_date = $row['order_date'];
                                    $status = $row['status'];
                                    $name = $row['customer_name'];
                                    $contact = $row['customer_contact'];
                                    $email = $row['customer_email'];
                                    $address = $row['customer_address'];

                                    switch ($status) {
                                        case 'Ordered':
                                            # code...
                                            $text_color = "text-primary";
                                            break;
                                        case 'On delivery':
                                            $text_color = "text-secondary";
                                            break;
                                        case 'Delivered':
                                            $text_color = "text-success";
                                            break;
                                        default:
                                            $text_color = 'text-error';
                                            
                                    }

                                    ?>
                                    <tr>
                                        <th scope="row"><?= $sn ?></th>
                                        <td><?= $product ?></td>
                                        <td><?= $qty ?></td>
                                        <td><?= $price ?></td>
                                        <td><?= $order_date ?></td>
                                        <td class="<?= $text_color ?>"><?= $status ?></td>
                                        <td><?= $name ?></td>
                                        <td><?= $contact ?></td>
                                        <td><?= $email ?></td>
                                        <td><?= $address ?></td>
                                        <td>
                                            <a href="<?= SITEURL ?>admin/update_order.php?id=<?= $id; ?>&status=<?= $status ?>" class="bg-white p-2 rounded mx-1" title="update product">
                                                <img src="../images/icons8-edit-64.png" width="25px" alt="">
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    $sn++;
                                }
                            }
                        ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include("widget/footer.php"); ?>
