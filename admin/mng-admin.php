<?php include('partials/menu.php'); ?>

<!-- main content -->
<div class="main-content">
    <div class="container">
        <h1 class="mb-3">Manage Admin</h1><hr>
        <a class="btn btn-primary" href="add-admin.php">Add Admin</a><br><br>
        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];//displaying session message
                unset($_SESSION['add']);//removing session message
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
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
                <th>Email</th>
                <th>Username</th>
                <th>Action</th>
            </tr>

            <?php
                //query to get all admin
                $sql = "SELECT * FROM admin"; 
                $res = mysqli_query($con,$sql);
                if($res == true){
                    $count = mysqli_num_rows($res);//function to get all the rows from the database
                    $sno = 1;//create a variable for S NO.
                    if($count>0){
                        while($rows=mysqli_fetch_assoc($res)){
                            $id = $rows['id'];
                            $email = $rows['email'];
                            $username = $rows['user_name'];
                            //displaying the value in our table
                            ?>

                            <tr>
                                <td><?php echo $sno++; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $username; ?></td>
                                <td><a class="btn btn-warning" href="<?php echo SITEURL; ?>/admin/update-admin.php?id=<?php echo $id; ?>">Edit</a>&nbsp;<a class="btn btn-danger" href="<?php echo SITEURL; ?>/admin/delete-admin.php?id=<?php echo $id; ?>">Delete</a></td>
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
