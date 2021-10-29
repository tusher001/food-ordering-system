<?php
    include('../config/constant.php');

    $id = $_GET['id'];
    $img_name = $_GET['img_name'];

    if($img_name != ''){
        $path = "../img/food/".$img_name;
        //remove the img
        $remove = unlink($path);
        if($remove == false){
            $_SESSION['remove'] = '<div class="alert alert-danger" role="alert">
                Failed to remove image!
            </div>';
            header('location:'.SITEURL.'admin/mng-food.php');
            die();
        }
    }

    $sql = "DELETE FROM `foods` WHERE `foods`.`id` = $id";
    
    $res = mysqli_query($con, $sql);
    if($res == true){
        $_SESSION['delete'] = '<div class="alert alert-success" role="alert">
          Food deleted successfully!
        </div>';
        header('location:'.SITEURL.'admin/mng-food.php');
    }else{
        $_SESSION['delete'] = '<div class="alert alert-danger" role="alert">
          Failed to delete food!
        </div>';
        header('location:'.SITEURL.'admin/mng-food.php');
    }
?>