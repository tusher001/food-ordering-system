<?php

    //include constant.php file
    include('../config/constant.php');

    $id = $_GET['id'];
    $img_name = $_GET['img_name'];

    //check img and delete it from folder
    if($img_name != ''){
        $path = "../img/category/".$img_name;
        //remove the img
        $remove = unlink($path);
        if($remove == false){
            $_SESSION['remove'] = '<div class="alert alert-danger" role="alert">
                Failed to remove image!
            </div>';
            header('location:'.SITEURL.'admin/mng-category.php');
            die();
        }
    }

    $sql = "DELETE FROM `category` WHERE `category`.`id` = $id";
    $res = mysqli_query($con, $sql);
    if($res == true){
        $_SESSION['delete'] = '<div class="alert alert-success" role="alert">
          Category deleted successfully!
        </div>';
        header('location:'.SITEURL.'admin/mng-category.php');
    }else{
        $_SESSION['delete'] = '<div class="alert alert-danger" role="alert">
          Failed to delete Category!
        </div>';
        header('location:'.SITEURL.'admin/mng-category.php');
    }
?>