<!-- FOR DATABASE CONNECTION -->
<?php 
  include('../config/constant.php');
  include('check-login.php'); 
?>

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


    <title>Food Order System - Admin</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light header-background fixed-top menu" role="navigation">
        <div class="container">
          <a href="index.html"><img id="logo" src="../img/logo.png"  alt=""></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto me-2">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="mng-admin.php">Admin</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="mng-category.php">Categories</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="mng-food.php">Foods</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="mng-order.php">Order</a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn btn-warning" href="logout.php">Logout</a>
              </li>
            </ul>
          </div>
        </div>
    </nav>