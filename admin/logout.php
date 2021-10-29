<?php
    //include constant php for site url
    include('../config/constant.php');
    //Destroy the session
    session_destroy();
    
    header('location:'.SITEURL.'admin/login.php');
?>