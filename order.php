<?php include("widget/header.php") ?>
<?php 
    $id = $_GET['id'];

    $sql = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);

    $image_name = $row['image_name'];
    $title = $row['title'];
    $price = $row['price'];
?>

    <!-- Order Form Section -->
    <div class="container">
        <div class="row p-3">
            <div class="col-md-8 mx-auto p-3">
                <br>
                <h2 class="text-center text-white">
                    Fill this form for to confirm your order
                </h2>
                <br>
                <form action="" class="row g-3" method="POST">
                    <fieldset class="border p-3 rounded-3 border-2">
                        <legend class="float-none w-auto p-2 text-white">Select Product</legend>

                        <div class="d-flex">
                            <img src="images/products/<?= $image_name ?>" alt="Lip stick" class="w-25 h-25 rounded-3">
                            <div class="px-3">
                                <h3><?= $title ?></h3>
                                <p>$ <?= $price ?></p>

                                <label for="inputNumber" class="form-label">Items</label>
                                <input type="number" class="form-control w-25" min="1" value="1" id="inputNumber" name="qty">
                            </div>
                        </div>

                    </fieldset>

                    <fieldset class="border p-3 rounded-3 border-2">

                        <legend class="float-none w-auto p-2 text-white">
                            Delivery Details
                        </legend>

                        <div class="col-md-12 mb-2">
                            <label for="inputName" class="form-label text-white">Name</label>
                            <input type="text" class="form-control" id="inputName" placeholder="James" name="name">
                        </div>

                        <div class="col-md-12  mb-2">
                            <label for="inputPhone" class="form-label text-white">Phone</label>
                            <input type="tel" class="form-control" id="inputPhone" placeholder="097979xxxxxx" name="contact">
                        </div>

                        <div class="col-md-12  mb-2">
                            <label for="inputEmail" class="form-label text-white">Email</label>
                            <input type="email" class="form-control" id="inputEmail" placeholder="someone@gmail.com" name="mail">
                        </div>

                        <div class="col-md-12  mb-2">
                            <label for="textarea" class="form-label text-white">Your Address </label>
                            <textarea class="form-control mt-1  mb-4" placeholder="Your Address Details" id="textarea" name="address"
                                style="height: 150px;"></textarea>
                        </div>

                        <input type="hidden" name="product" value="<?= $title ?>">
                        <input type="hidden" name="price" value="<?= $price ?>">
                        <button type="submit" class="btn btn-primary w-40">Confirm Order</button>
                        
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <!-- Order Form Section -->


<?php include("widget/footer.php") ?>

<?php 
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // echo "clicked";
        $product_title = $_POST['product'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total = $price * $qty;
        $order_date = date("Y-m-d H:i:s");
        $status = "Ordered";
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $email = $_POST['mail'];
        $address = $_POST['address'];

        $sql = "INSERT INTO orders SET
            product = '$product_title',
            price = $price,
            qty = $qty,
            total = $total,
            order_date = '$order_date',
            status = '$status',
            customer_name = '$name',
            customer_contact = '$contact',
            customer_email = '$email',
            customer_address = '$address'

        ";
        $result = mysqli_query($conn,$sql);
        if($result){
            $_SESSION['noti'] = '<div class="alert alert-success" role="alert">
                                    Order Placed Successfully
                                </div>';
            header('location:'.SITEURL.'index.php');
        }else{
            $_SESSION['noti'] = '<div class="alert alert-danger" role="alert">
                                    Failed To Place Order
                                </div>';
            header('location:'.SITEURL.'index.php');
        }
    }
?>
    