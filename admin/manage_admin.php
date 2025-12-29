<?php include("widget/header.php"); ?>

    <div class="container">
        <div class="row pt-4 pb-4 gt-3">

            <?php 
                if (isset($_SESSION['noti'])) {
                    echo $_SESSION['noti'];
                    unset($_SESSION['noti']);
                }
            ?>

            <h2 class="mt-4 mb-3">Manage Admin</h2>
            
            <!-- Admin Table  -->
             <div class="col-12">
                <a href="add_admin.php" class="btn btn-primary w-10 mb-3">Add Admin</a>

                <table class="table table-striped table-light">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    <!-- Retrieve Data from Database -->
                    <?php 
                        $sql = "SELECT * FROM admin";
                        $result = mysqli_query($conn,$sql);

                        if ($result) {
                            $count = mysqli_num_rows($result); // count the num of rows from db

                            if ($count == 0) {
                                echo "No data";
                            }else{
                                $sn = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['id'];
                                    $fullname = $row['fullname'];
                                    $username = $row['username'];
                                    $password = $row['password'];

                                    ?>
                                    <!-- Now, you can put HTML code  -->
                                        <tr>
                                            <th scope="row"><?= $sn; ?></th>
                                                <td><?= $fullname; ?></td>
                                                <td><?= $username; ?></td>
                                                <td>
                                                    <a href="<?= SITEURL ?>admin/update_password.php?id=<?= $id; ?>" class="bg-white p-2 rounded mx-1" title="update password">
                                                        <img src="../images/icons8-forgot-password-64.png" width="25px" alt="">
                                                    </a>
                                                    <a href="<?= SITEURL ?>admin/update_admin.php?id=<?= $id; ?>" class="bg-white p-2 rounded mx-1" title="update admin">
                                                        <img src="../images/icons8-edit-64.png" width="25px" alt="">
                                                    </a>
                                                    <a href="<?= SITEURL ?>admin/delete_admin.php?id=<?= $id; ?>" class="bg-white p-2 rounded mx-1" title="delete admin">
                                                        <img src="../images/icons8-delete-100.png" width="25px" alt="">
                                                    </a>
                                                </td>
                                            </tr>
                                    <?php
                                    $sn++;

                                }
                            }
                        }
                    ?>


                    </tbody>
                </table>
             </div>
        </div>
    </div>

<?php include("widget/footer.php"); ?>
