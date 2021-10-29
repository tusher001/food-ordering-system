<?php include('partials/menu.php'); ?>

<!-- main content -->
<div class="main-content">
        <div class="container">
            <h1 class="mb-3">Manage Foods</h1>
            <a class="btn btn-primary" href="add-food.php">Add Food</a><br><br>
            <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['remove'])){
                    echo $_SESSION['remove'];
                    unset($_SESSION['remove']);
                }
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
                if(isset($_SESSION['failed-remove'])){
                    echo $_SESSION['failed-remove'];
                    unset($_SESSION['failed-remove']);
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>
            <div class="col-12">
                <table>
                <tr>
                    <th>S No.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM foods";
                    $res = mysqli_query($con,$sql);
                    if($res == true){
                        $count = mysqli_num_rows($res);
                        $sno = 1;
                        if($count>0){
                            while($rows=mysqli_fetch_assoc($res)){
                                $id = $rows['id'];
                                $title = $rows['title'];
                                $price = $rows['price'];
                                $img_name = $rows['img_name'];
                                $featured = $rows['featured'];
                                $active = $rows['active'];
                                ?>

                                <tr>
                                    <td><?php echo $sno++ ?></td>
                                    <td><?php echo $title ?></td>
                                    <td><?php echo $price ?>/-</td>
                                    <td>
                                        <?php
                                            if($img_name != ""){
                                                ?>
                                                <img src='<?php echo SITEURL; ?>img/food/<?php echo $img_name; ?>' width="50px">
                                                <?php
                                            } 
                                            else{
                                                echo "Image not added";
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured ?></td>
                                    <td><?php echo $active ?></td>
                                    <td><a class="btn btn-warning" href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>">Edit</a>&nbsp;<a class="btn btn-danger" href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&img_name=<?php echo $img_name; ?>">Delete</a></td>
                                </tr>

                                <?php
                            }
                        }
                        else{
                            echo "<tr><td colspan='7'>Food not added yet.</td></tr>";
                        }
                    } 
                ?>
                </table>
            </div>
        </div>
</div>

<?php include('partials/footer.php'); ?>