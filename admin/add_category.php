<?php include("widget/header.php"); ?>
    <div class="container">
        <div class="row pt-4 pb-4 text-color">
             <?php 
                if (isset($_SESSION['noti'])) {
                    echo $_SESSION['noti'];
                    unset($_SESSION['noti']);
                }            
            ?>

            <h2 class="mt-4 mb-3">Add New Category</h2>

            <div class="col-12">
                <div class="border p-3 rounded-3">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="image" class="form-label">Choose Image</label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="" class="form-label">Featured</label>
                                <div class="bg-body p-1 rounded ps-3">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" id="featured1" value="YES" name="featured">
                                        <label for="featured1" class="form-check-label">YES</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" id="featured2" value="NO" name="featured">
                                        <label for="featured2" class="form-check-label">NO</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="" class="form-label">Active</label>
                                <div class="bg-body p-1 rounded ps-3">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" id="active1" value="YES" name="active">
                                        <label for="active1" class="form-check-label">YES</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" id="active2" value="NO" name="active">
                                        <label for="active2" class="form-check-label">NO</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include("widget/footer.php"); ?>

<?php 
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // echo "clicked";
        $title = $_POST['title'];
        if (isset($_POST['featured'])) {
            $featured = $_POST['featured'];
        }else{
            $featured = 'No';
        }

        if (isset($_POST['active'])) {
            $active = $_POST['active'];
        }else{
            $active = 'No';
        }

        if (isset($_FILES['image']['name'])) {
            $image_name = $_FILES['image']['name'];

            $ext = end(explode('.',$image_name)); // rename the image
            // for eg.=> example.jpg

            $image_name = "category_" . rand(000,999). '.' . $ext;
            // for eg=> category_001.jpg

            $source_path = $_FILES['image']['tmp_name'];

            $destination_path = "../images/categories/" . $image_name;

            $upload = move_uploaded_file($source_path,$destination_path);

            if (!$upload) {
                  $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                            Failed To Upload Image
                                        </div>';
                    header('location:'.SITEURL.'admin/add_category.php');
                    die();
            }

        }

        $sql = "INSERT INTO categories SET
                title = '$title',
                featured = '$featured',
                active = '$active',
                image_name = '$image_name'
        ";
        $result = mysqli_query($conn,$sql);

        if($result){
            $_SESSION['noti'] = '<div class="alert alert-success" role="alert">
                                    Cagegory Added Successfully
                                </div>';
            header('location:'.SITEURL.'admin/manage_category.php');
        }else{
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    Failed To Add Category
                                </div>';
            header('location:'.SITEURL.'admin/add_category.php');
        }
    }
?>
