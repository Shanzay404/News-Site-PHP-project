<?php 

    include "db_connect.php"; 
    if($_SESSION['user_role'] == "0"){
        header("Location: ".$hostName."admin/post.php");
    }

    $user_id = $_GET['id'];

    $sql = "DELETE FROM `user` WHERE `user`.`user_id` = '{$user_id}'";

    $result =  mysqli_query($conn, $sql) or die ("Query Failed");

    if($result){
        header("Location: ".$hostName."admin/users.php");
    }






?>