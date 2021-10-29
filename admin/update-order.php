<?php 
    ob_start();
    include('partials/menu.php'); 
?>

<div class="main-content">
    <div class="container">
        <h1>Update Order</h1><hr>
        <?php
        if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
        <?php

          if(isset($_GET['id'])){
            $id = $_GET['id'];
            $sql = "SELECT * FROM t_order WHERE t_order.id=$id";
            $res = mysqli_query($con,$sql);
            $count = mysqli_num_rows($res);
            if($count == 1){
                $row = mysqli_fetch_assoc($res);
                $food = $row['food'];
                $price = $row['price'];
                $quantity = $row['quantity'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];
            }
            else{
                header('location:'.SITEURL.'admin/mng-order.php');
            }
          }
          else{
              header('location:'.SITEURL.'admin/mng-order.php');
          }
        ?>

        <form action="" method="post" class="row g-2">
            <div class="col-md-6">
              <label for="fname" class="form-label">Food name : </label>
              <label for="fname" class="form-label"><?php echo "<b style='color: rgb(244,47,44);'>". $food ."</b>"; ?></label>
            </div>
            <div class="col-md-6">
              <label for="price" class="form-label">Price :</label>
              <label for="price" class="form-label"><?php echo "<b style='color: rgb(244,47,44);'>". $price ."</b>"; ?></label>
            </div>
            <div class="col-md-6">
              <label for="quantity" class="form-label">Quantity</label>
              <input type="number" name="quantity" class="form-control" id="quantity" value="<?php echo $quantity; ?>">
            </div>
            <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option <?php if($status == "Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                    <option <?php if($status == "On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                    <option <?php if($status == "Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                    <option <?php if($status == "Canceled"){echo "selected";} ?> value="Canceled">Canceled</option>
                </select>
            </div>
            <div class="col-md-6">
              <label for="cname" class="form-label">Customer name</label>
              <input type="text" name="cname" class="form-control" id="cname" value="<?php echo $customer_name; ?>">
            </div>
            <div class="col-md-6">
              <label for="contact" class="form-label">Customer contact</label>
              <input type="text" name="contact" class="form-control" id="contact" value="<?php echo $customer_contact; ?>">
            </div>
            <div class="col-md-6">
              <label for="email" class="form-label">Customer email</label>
              <input type="email" name="email" class="form-control" id="email" value="<?php echo $customer_email; ?>">
            </div>
            <div class="col-md-6">
              <label for="address" class="form-label">Customer address</label>
              <input type="text" name="address" class="form-control" id="address" value="<?php echo $customer_address; ?>">
            </div>
            <div class="col-12 text-center">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="hidden" name="price" value="<?php echo $price; ?>">
              <br><button type="submit" name="submit" class="btn btn-primary" id="submit">UPDATE</button>
            </div>
        </form>

        <?php
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $price = $_POST['price'];
                $quantity = $_POST['quantity'];
                $total = $price * $quantity;
                $status = $_POST['status'];
                $customer_name = $_POST['cname'];
                $customer_email = $_POST['email'];
                $customer_contact = $_POST['contact'];
                $customer_address = $_POST['address']; 

                $sql2 = "UPDATE t_order SET quantity=$quantity, total=$total, status='$status', customer_name='$customer_name', customer_contact='$customer_contact', customer_email='$customer_email',customer_address='$customer_address' WHERE id='$id'";
                
                $res2 = mysqli_query($con,$sql2);
                if($res2){
                    $_SESSION['update'] = '<div class="alert alert-success" role="alert">
                    Order updated successfully!
                  </div>';
                    header('location:'.SITEURL.'admin/mng-order.php');
                }
                else{
                    $_SESSION['update'] = '<div class="alert alert-success" role="alert">
                    Failed to update order!
                  </div>';
                    header('location:'.SITEURL.'admin/update-order.php');
                }
            }
        ?>

    </div>
</div>

<?php 
    include('partials/footer.php'); 
    ob_end_flush();
?>