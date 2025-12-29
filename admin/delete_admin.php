<?php 
    include('../config.php');

    $id = $_GET['id'];

    $sql = "DELETE FROM admin WHERE id = $id";

    $result = mysqli_query($conn,$sql);

    if($result){
            $_SESSION['noti'] = '<div class="alert alert-success" role="alert">
                                    Admin deleted Successfully
                                </div>';
            header('location:'.SITEURL.'admin/manage_admin.php');
    }else{
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    Failed To Delete Admin
                                </div>';
            header('location:'.SITEURL.'admin/add_admin.php');
     }

?>
