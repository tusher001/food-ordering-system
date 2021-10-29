<?php 

    // Session start
    session_start();

    //CREATE CONSTANT TO CREATE NON REPLACEABLE VALUE
    define('SITEURL','http://localhost/food-ordering-system/');
    define('LOCALHOST','localhost');
    define('USERNAME','root');
    define('PASSWORD','');
    define('DB_NAME','food-order');

    $con = mysqli_connect(LOCALHOST, USERNAME, PASSWORD, DB_NAME);
    if(!$con){
        die("Connection to this database failed due to " . mysqli_connect_error());
    }
?>