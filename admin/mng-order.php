<?php include('partials/menu.php'); ?>

<!-- main content -->
<div class="main-content">
        <div class="container">
            <h1 class="mb-3">Manage Order</h1>
            <?php
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            ?>
            <div class="col-12">
                <table>
                <tr>
                    <th>S No.</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Order date</th>
                    <th>Customer name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
                <?php
                    $sql  = "SELECT * FROM `t_order` ORDER BY `id` DESC";
                    $res = mysqli_query($con,$sql);
                    $count = mysqli_num_rows($res);
                    $sno = 1;
                    if($count > 0){
                        while($row = mysqli_fetch_array($res)){
                            $id = $row["id"];
                            $food = $row["food"];
                            $price = $row["price"];
                            $quantity = $row["quantity"];
                            $total = $row["total"];
                            $order_date = $row["order_date"];
                            $status = $row["status"];
                            $customer_name = $row["customer_name"];
                            $customer_contact = $row["customer_contact"];
                            $customer_email = $row["customer_email"];
                            $customer_address = $row["customer_address"];
                            ?>

                            <tr>
                                <td><?php echo $sno++; ?></td>
                                <td><?php echo $food; ?></td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $quantity; ?></td>
                                <td><?php echo $total; ?></td>
                                <td><?php echo $order_date; ?></td>
                                <td>
                                    <?php
                                        if($status == "Ordered"){
                                            echo "<label style='color: aqua;'>$status</label>";
                                        }
                                        else if($status == "On Delivery"){
                                            echo "<label style='color: orange;'>$status</label>";
                                        }
                                        else if($status == "Delivered"){
                                            echo "<label style='color: green;'>$status</label>";
                                        }
                                        else if($status == "Canceled"){
                                            echo "<label style='color: red;'>$status</label>";
                                        }
                                    ?>
                                </td>
                                <td><?php echo $customer_name; ?></td>
                                <td><?php echo $customer_contact; ?>@gmail.com</td>
                                <td><?php echo $customer_address; ?></td>
                                <td><a class="btn btn-warning" href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>">Update</a>&nbsp;</td>
                            </tr>

                            <?php
                        }
                    }
                    else{
                        echo "<tr><td colspan='12'>Order not Available</td></tr>";
                    }
                ?>
                </table>
            </div>
        </div>
    </div>

<?php include('partials/footer.php'); ?>