<?php 

    include "db_connect.php"; 
    session_start();
    if($_SESSION['user_role'] == "0"){
        header("Location: ".$hostName."admin/post.php");
    }

    $cat_id = $_GET['id'];

   $sql = "DELETE FROM `category` WHERE `category`.`category_id` = {$cat_id}";


    $result =  mysqli_query($conn, $sql) or die ("Query Failed");

    if($result){
        header("Location: {$hostname}category.php");
    }






?>