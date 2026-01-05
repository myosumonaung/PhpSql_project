<?php 
    include("../config.php");

    if (isset($_GET['id']) AND isset($_GET['image_name'])) {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if ($image_name != null) {
            $path = "../images/categories/" . $image_name;

            $remove = unlink($path); //remove the image

            if (!$remove) {
                $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                        Failed to delete category!
                                    </div>';
                header('location:'.SITEURL.'admin/manage_category.php');
                die();
            }
        }

        $sql = "DELETE FROM categories WHERE id=$id";
        $result = mysqli_query($conn,$sql);
        if ($result) {
            $_SESSION['noti'] = '<div class="alert alert-success" role="alert">
                                    Category deleted Successfully
                                </div>';
            header('location:'.SITEURL.'admin/manage_category.php');
        }else{
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                        Failed to delete category!
                                </div>';
            header('location:'.SITEURL.'admin/manage_category.php');
        }
    }else{
        $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                Failed to delete category!
                            </div>';
        header('location:'.SITEURL.'admin/manage_category.php');
    }
?>