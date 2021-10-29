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
    <style>
        .content{
            margin: 10px 5px;
        }
        .register{
            width: 50%;
            padding: 30px 40px;
            margin: 0 auto;
            background-image: linear-gradient(to left, rgb(116, 16, 14) , rgb(244,47,44));
            color: white;
            margin-top: 5%;
            border-radius: 5px;
            box-shadow: 5px 5px 5px 1px gray;
        }
    </style>

    <title>Register - Food ordering system</title>
  </head>
  <body>
    
    <div class="content">
        <div class="container">
            <h1 style="text-align: center;">Complete your Registration</h1><hr>
            <?php
                if(isset($_SESSION['register'])){
                    echo $_SESSION['register'];
                    unset($_SESSION['register']);
                }
            ?>
            <div class="register">
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
                    <button type="submit" name="submit" class="btn btn-info" id="submit">REGISTER</button>
                    </div>
                </form>
                <?php
                    if(isset($_POST['submit'])){
                        $email = $_POST['email'];
                        $username = $_POST['uname'];
                        $password = md5($_POST['password']); //Password encryption with md5
                        
                        //SQL query to insert data into database
                        $sql = "INSERT INTO `food-order`.`admin` (`email`, `user_name`, `password`) VALUES ('$email', '$username', '$password');";

                        if($con->query($sql)==true){      
                            $_SESSION['register'] = '<div class="alert alert-success text-center" role="alert">
                            Registration successfully, Login to Enter !
                        </div>';
                            //Redirect page
                            header('location:'.SITEURL.'admin/login.php');
                        }
                        else{
                            $_SESSION['register'] = '<div class="alert alert-danger text-center" role="alert">
                            Registration Failed!
                        </div>';
                            //Redirect page
                            header('location:'.SITEURL.'admin/register.php');
                        }
                    }
                ?>
            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
  </body>
</html>

