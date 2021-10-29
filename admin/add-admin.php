<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="container">
        <h1>Add Admin</h1><hr>
        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];//displaying session message
                unset($_SESSION['add']);//removing session message
            }
        ?>
        <form action="" method="post" class="row g-3">
            <div class="col-md-12">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" class="form-control" id="email" placeholder="Enter your full email">
            </div>
            <div class="col-md-12">
              <label for="uname" class="form-label">User Name</label>
              <input type="text" name="uname" class="form-control" id="uname" placeholder="Enter your username">
            </div>
            <div class="col-md-12">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
            </div>
            <div class="col-12 text-center">
              <button type="submit" name="submit" class="btn btn-primary" id="submit">ADD ADMIN</button>
            </div>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<!-- Process the value and save it to the Database -->
<?php
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $username = $_POST['uname'];
        $password = md5($_POST['password']); //Password encryption with md5
        
        //SQL query to insert data into database
        $sql = "INSERT INTO `food-order`.`admin` (`email`, `user_name`, `password`) VALUES ('$email', '$username', '$password');";

        if($con->query($sql)==true){      
            $_SESSION['add'] = '<div class="alert alert-success" role="alert">
            Admin added successfully!
          </div>';
            //Redirect page
            header('location:'.SITEURL.'admin/mng-admin.php');
        }
        else{
            $_SESSION['add'] = '<div class="alert alert-success" role="alert">
            Failed to add admin!
          </div>';
            //Redirect page
            header('location:'.SITEURL.'admin/add-admin.php');
        }
    }
?>