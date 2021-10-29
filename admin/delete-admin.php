<?php

    //include constant.php file
    include('../config/constant.php');

    $id = $_GET['id'];

    $sql = "DELETE FROM `admin` WHERE `admin`.`id` = $id";
    $res = mysqli_query($con, $sql);
    if($res == true){
        $_SESSION['delete'] = '<div class="alert alert-success" role="alert">
          Admin deleted successfully!
        </div>';
        header('location:'.SITEURL.'admin/mng-admin.php');
    }else{
        $_SESSION['delete'] = '<div class="alert alert-danger" role="alert">
          Failed to delete admin!
        </div>';
        header('location:'.SITEURL.'admin/mng-admin.php');
    }
?>