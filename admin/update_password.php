<?php include("widget/header.php"); ?>

    <?php
        $id = $_GET['id'];

        $sql = "SELECT * FROM admin WHERE id=$id";

        $result = mysqli_query($conn,$sql);

        if ($result) {
            $count = mysqli_num_rows($result);
            if ($count == 1) {
                $row = mysqli_fetch_assoc($result);
                $retrieve_psw = $row['password'];
                
            }else{
                $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                        Failed To Update Password
                                    </div>';
                header('location:'.SITEURL.'admin/manage_admin.php');
            }
        }
    ?>

    <div class="container">
        <div class="row pt-4 pb-4 text-color gt-3">
            <?php 
                if (isset($_SESSION['noti'])) {
                    echo $_SESSION['noti'];
                    unset($_SESSION['noti']);
                }
            ?>

            <h2 class="mt-4 mb-4">Update Password</h2>

            <!-- Add admin form  -->
             <div class="col-md-6">
                <div class="border p-3 rounded-3">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="current-psw" class="form-label">Current Password</label>
                            <input type="password" class="form-control" name="current-psw" id="current-psw" required>
                        </div>
                         <div class="mb-3">
                            <label for="new-psw" class="form-label">New Password</label>
                            <input type="password" class="form-control" name="new-psw" id="new-psw" required>
                        </div>
                         <div class="mb-3">
                            <label for="confirm-psw" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm-psw" id="confirm-psw" required>
                        </div>

                        <input type="hidden" name="id" value="<?= $id ?>">
                        <input type="hidden" name="retrieve-psw" value="<?= $retrieve_psw ?>">

                        <input type="submit" value="Update Password" class="btn btn-primary">

                    </form>
                </div>
             </div>
        </div>
    </div>


<?php include("widget/footer.php"); ?>

<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // echo "clicked";
        $id = $_POST['id'];
        $retrieve_psw = $_POST['retrieve-psw'];
        $current_psw = md5($_POST['current-psw']);
        $new_psw = md5($_POST['new-psw']);
        $confirm_psw = md5($_POST['confirm-psw']);

        if ($retrieve_psw != $current_psw) {
             $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    Current Password Incorrect!
                                </div>';
            header('location:'.SITEURL.'admin/update_password.php?id='.$id);
        }else if ($new_psw != $confirm_psw) {
             $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    Not Match , New Password & Confirm Password !
                                </div>';
            header('location:'.SITEURL.'admin/manage_admin.php');
        }else{
            $sql = "UPDATE admin SET
                password = '$new_psw'
                WHERE id='$id'
            ";
            $result = mysqli_query($conn,$sql);

            if($result){
            $_SESSION['noti'] = '<div class="alert alert-success" role="alert">
                                    Password Updated Successfully
                                </div>';
            header('location:'.SITEURL.'admin/manage_admin.php');
            }else{
                $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                        Failed To Update Password
                                    </div>';
                header('location:'.SITEURL.'admin/manage_admin.php');
            }
        }
    }

?>

