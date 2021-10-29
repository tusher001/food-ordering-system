<?php include('../config/constant.php'); ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/admin.css">

    <!-- FontAwesome Icon -->
    <script src="https://kit.fontawesome.com/7e021e3b71.js" crossorigin="anonymous"></script>


    <title>Login - Food ordering system</title>
  </head>
  <body>
    <div class="container">
        <div class="loghp">
            <h1>TS Food</h1>
            <p>Wid option of choice</p>
        </div>
        
        <?php
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-msg'])){
                echo $_SESSION['no-login-msg'];
                unset($_SESSION['no-login-msg']);
            }
            if(isset($_SESSION['register'])){
                echo $_SESSION['register'];
                unset($_SESSION['register']);
            }
        ?>
        
        <div class="login">
            <form action="" method="POST">
                <p class="text-center">Please login to your account</p>
                
                <label for="uname" class="form-label">User Name</label>
                <input type="text" name="uname" class="form-control" id="uname" placeholder="Enter your username">
                
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
                
                <button type="submit" name="submit" class="btn btn-primary" id="submit">LOGIN</button><br><br>
                <p>Or Sing Up Using</p>
                <b><a style="color: rgb(244,47,44);" href="<?php echo SITEURL; ?>admin/register.php">SING UP</a></b>
                
            </form>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
  </body>
</html>

<?php
    if(isset($_POST['submit'])){
        $username = $_POST['uname'];
        $password = md5($_POST['password']);

        //sql query to check weather user with this username and password is exists or not
        $sql = "SELECT * FROM admin WHERE admin.user_name='$username' AND admin.password = '$password'";
        $res = mysqli_query($con,$sql);
        $count = mysqli_num_rows($res);
        if($count == 1){
            //login success
            $_SESSION['login'] = '<div class="alert alert-success" role="alert">
                Successfully login!
            </div>';
            $_SESSION['user'] = $username;
            header('location:'.SITEURL.'admin/');
        }else{
            //login failed
            $_SESSION['login'] = '<div class="alert alert-danger text-center" role="alert">
                Username and password did not match!
            </div>';
            header('location:'.SITEURL.'admin/login.php');
        }
    }
?>