
<?php
    ob_start();
    include('partials-front/menu.php'); 
?>

<?php
    if(isset($_GET['food_id'])){
        $food_id = $_GET['food_id'];
        $sql = "SELECT * FROM `foods` WHERE foods.id=$food_id";
        $res = mysqli_query($con,$sql);
        $count = mysqli_num_rows($res);
        if($count == 1){
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $price = $row['price'];
            $img_name = $row['img_name'];
        }
        else{
            header('location:'.SITEURL);
        }
    }
    else{
        header('location:'.SITEURL);
    }
?>

<div class="orderBg">
    <div class="container py-5" style="margin-top: 50px;">
        <h1 class="text-center">Fill this from to conform your order</h1>
    <div class="order-from">
        <form action="" method="post" class="row">
            <fieldset>
                <legend class="text-center">Selected Food</legend><hr>
                <div class="row">
                    <div class="col-md-3 text-center">
                        <?php
                            if($img_name == ''){
                                echo "<div class='alert alert-danger' role='alert'>
                                        Image not available!
                                      </div>";
                            }
                            else{
                                ?>

                                    <img src="<?php echo SITEURL; ?>/img/food/<?php echo $img_name; ?>" alt="...">

                                <?php
                            }
                        ?>
                    </div>
                    <div class="col-md-8">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <h5><?php echo $price; ?>/-</h4>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <label for="quantity" class="form-label" style="font-weight: bold;">Quantity</label>
                        <input type="number" name="quantity" class="form-control" id="quantity" value="1">
                    </div>
                </div> 
            </fieldset>
                
                <legend class="text-center">Delivery Details</legend><hr>
                <div class="col-md-12">
                    <label for="fname" class="form-label">Full Name</label>
                    <input type="text" name="fname" class="form-control" id="fname" placeholder="Enter your full name">
                </div>
                <div class="col-md-12">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="phone" name="phone" class="form-control" id="phone" placeholder="+880 1*********">
                </div>
                <div class="col-md-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="hi@gmail.com">
                </div>
                <div class="col-md-12">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" id="address" placeholder="E.g. Area, Street, City"><br>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" name="submit" class="btn org-btn" id="submit">Conform order</button>
                </div>
            </form>

            <?php
                if(isset($_POST['submit'])){
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $quantity = $_POST['quantity'];
                    $total = $price * $quantity;
                    $order_date = date("Y.m.d h:i:sa");
                    $status = "Ordered";
                    $customer_name = $_POST['fname'];
                    $customer_contact = $_POST['phone'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    $sql2 = "INSERT INTO `food-order`.`t_order` (`food`, `price`, `quantity`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES ('$food','$price', '$quantity', '$total', '$order_date', '$status', '$customer_name', '$customer_contact', '$customer_email', '$customer_address')";

                    $res2 = mysqli_query($con, $sql2);
                    if($res2 == true){
                        $_SESSION['order'] = "<div class='alert alert-success' role='alert'>
                        Order placed successfully!
                      </div>";
                      header('location:'.SITEURL);
                    }
                    else{
                        $_SESSION['order'] = "<div class='alert alert-danger' role='alert'>
                        Failed to placed order!
                      </div>";
                      header('location:'.SITEURL);
                    }
                }
            ?>

        </div>
    </div>
</div>

<?php 
    include('partials-front/footer.php'); 
    ob_end_flush();
?>