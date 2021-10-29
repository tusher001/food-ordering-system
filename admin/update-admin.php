<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="container">
        <h1>Update admin</h1><hr>
        
        <?php
          $id = $_GET['id'];
          $sql = "SELECT * FROM admin WHERE admin.id=$id";
          $res = mysqli_query($con,$sql);
          if($res == true){
            $count = mysqli_num_rows($res);
            if($count == 1){
              $row = mysqli_fetch_assoc($res);
              $email = $row['email'];
              $username = $row['user_name'];
            }else{
              header('location:'.SITEURL.'admin/mng-admin.php');
            }
          }
        ?>

        <form action="" method="post" class="row g-3">
            <div class="col-md-12">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" class="form-control" id="email" placeholder="Enter your full email" value="<?php echo $email; ?>">
            </div>
            <div class="col-md-12">
              <label for="uname" class="form-label">User Name</label>
              <input type="text" name="uname" class="form-control" id="uname" placeholder="Enter your username" value="<?php echo $username; ?>">
            </div>
            <div class="col-12 text-center">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <button type="submit" name="submit" class="btn btn-primary" id="submit">Update</button>
            </div>
          </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<!-- Process the value and save it to the Database -->
<?php
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $email = $_POST['email'];
        $username = $_POST['uname'];
        
        //SQL query to update data into database
        $sql = "UPDATE admin SET email='$email',user_name='$username' WHERE id='$id'";


        if($con->query($sql)==true){      
            $_SESSION['update'] = '<div class="alert alert-success" role="alert">
            Admin updated successfully!
          </div>';
            //Redirect page
            header('location:'.SITEURL.'admin/mng-admin.php');
        }
        else{
            $_SESSION['update'] = '<div class="alert alert-success" role="alert">
            Failed to update admin!
          </div>';
            //Redirect page
            header('location:'.SITEURL.'admin/add-admin.php');
        }
    }
?>