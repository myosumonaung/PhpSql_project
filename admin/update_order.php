<?php include("widget/header.php") ?>
<?php 
    $id = $_GET['id'];
    $status = $_GET['status'];
?>
    <div class="container">
        <div class="row pt-4 pb-4 text-color gt-3">
            <?php 
                if (isset($_SESSION['noti'])) {
                    echo $_SESSION['noti'];
                    unset($_SESSION['noti']);
                }
            ?>

            <h2 class="mt-4 mb-4">Update Order Status</h2>

            <!-- Add admin form  -->
             <div class="col-md-6">
                <div class="border p-3 rounded-3">
                    <form action="" method="POST">
                        <div class="col-6 mb-3 form-check">
                            <label for="s1" class="form-check-label">Ordered</label>
                            <input type="radio" class="form-check-input" 
                            <?php if ($status == "Ordered") {
                                # code...
                            } ?>
                            name="status" value="Ordered" id="s1">
                        </div>
                        <div class="col-6 mb-3 form-check">
                            <label for="s2" class="form-check-label">On Delivery</label>
                            <input type="radio" class="form-check-input" 
                            <?php if ($status == "On Delivery") {
                                # code...
                            } ?>
                            name="status" value="On Delivery" id="s2">
                        </div>
                        <div class="col-6 mb-3 form-check">
                            <label for="s3" class="form-check-label">Delivered</label>
                            <input type="radio" class="form-check-input" 
                            <?php if ($status == "Delivered") {
                                # code...
                            } ?>
                            name="status" value="Delivered" id="s3">
                        </div>
                        <div class="col-6 mb-3 form-check">
                            <label for="s4" class="form-check-label">Canceled</label>
                            <input type="radio" class="form-check-input" 
                            <?php if ($status == "Canceled") {
                                # code...
                            } ?>
                            name="status" value="Canceled" id="s4">
                        </div>

                        <input type="hidden" name="id" value="<?= $id ?>">

                        <input type="submit" value="Update" class="btn btn-primary">
                    </form>
                </div>
             </div>
        </div>
    </div>

<?php include("widget/footer.php") ?>;

<?php 
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = $_POST['id'];
        $new_status = $_POST['status'];

        $sql = "UPDATE orders SET
            status = '$new_status'
            WHERE id=$id
        ";

        $result = mysqli_query($conn,$sql);
        if($result){
            $_SESSION['noti'] = '<div class="alert alert-success" role="alert">
                                    Order  Updated Successfully
                                </div>';
            header('location:'.SITEURL.'admin/manage_order.php');
        }else{
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    Failed To Update Order
                                </div>';
            header('location:'.SITEURL.'admin/manage_order.php');
        }
    }
?>