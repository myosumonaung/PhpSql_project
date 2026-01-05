<?php include("widget/header.php"); ?>
    <div class="container">
        <div class="row pt-4 pb-4 text-color">
             <?php 
                if (isset($_SESSION['noti'])) {
                    echo $_SESSION['noti'];
                    unset($_SESSION['noti']);
                }            
            ?>

            <h2 class="mt-4 mb-3">Add New Product</h2>

            <div class="col-12">
                <div class="border p-3 rounded-3">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="col-2 mb-3">
                                <label for="price" class="form-label">Price $</label>
                                <input type="number" class="form-control" name="price" id="price">
                            </div>
                            <div class="col-4 mb-3">
                                <label for="select-category" class="form-label">Category</label>
                                <select name="category" id="select-category" class="form-select">
                                    <!-- Get category data from database -->
                                     <?php 
                                        $sql = "SELECT * FROM categories WHERE active = 'YES'";
                                        $result = mysqli_query($conn,$sql);
                                        $count = mysqli_num_rows($result);

                                        if ($count >0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $id = $row['id'];
                                                $title = $row['title'];

                                                ?>
                                                    <option value="<?= $id ?>"<?= $title ?>></option>
                                                <?php 
                                            }
                                        }else{
                                            echo '<option value="0"> No Category</option>';
                                        }
                                     ?>
                                </select>
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
