<?php
  //check the user is login or not
  if(!isset($_SESSION['user'])){
    $_SESSION['no-login-msg'] = '<div class="alert alert-danger text-center" role="alert">
        Login to access admin panel!
    </div>';
    header('location:'.SITEURL.'admin/login.php');
  }
?>