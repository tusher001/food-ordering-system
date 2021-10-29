<?php include('partials/menu.php'); ?>

<!-- main content -->
<div class="main-content">
    <div class="container">
        <h1 class="mb-3">Manage Category</h1>
        <a class="btn btn-primary" href="add-category.php">Add Category</a><br><br>
        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];//displaying session message
                unset($_SESSION['add']);//removing session message
            }
            if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];//displaying session message
                unset($_SESSION['remove']);//removing session message
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];//displaying session message
                unset($_SESSION['delete']);//removing session message
            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];//displaying session message
                unset($_SESSION['update']);//removing session message
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];//displaying session message
                unset($_SESSION['upload']);//removing session message
            }
            if(isset($_SESSION['failed-remove'])){
                echo $_SESSION['failed-remove'];//displaying session message
                unset($_SESSION['failed-remove']);//removing session message
            }
        ?>
        <div class="col-12">
            <table>
            <tr>
                <th>S No.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>

            <?php
                $sql = "SELECT * FROM category"; 
                $res = mysqli_query($con,$sql);
                if($res == true){
                    $count = mysqli_num_rows($res);
                    $sno = 1;//create a variable for S NO.
                    if($count>0){
                        while($rows=mysqli_fetch_assoc($res)){
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $img_name = $rows['img_name'];
                            $featured = $rows['featured'];
                            $active = $rows['active'];
                            ?>
                            <tr>
                                <td><?php echo $sno++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td>
                                    <?php
                                    if($img_name != ""){
                                        ?>
                                        <img src='<?php echo SITEURL; ?>img/category/<?php echo $img_name; ?>' width="50px">
                                        <?php
                                    }else{
                                        echo "Image not added";
                                    }
                                    ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td><a class="btn btn-warning" href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>">Edit</a>&nbsp;<a class="btn btn-danger" href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&img_name=<?php echo $img_name; ?>">Delete</a></td>
                            </tr>
                            <?php
                        }
                    }
                    else{

                    }
                }
            ?>
            </table>
        </div>
    </div>
</div>

<?php include('partials/footer.php'); ?>