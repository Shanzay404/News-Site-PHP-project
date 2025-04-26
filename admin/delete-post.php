<?php 
    include "db_connect.php";


    $post_id = $_GET['post_id'];
    $cat_id = $_GET['cat_id'];

    $sqlSelect = "SELECT * FROM `post` WHERE `post`.`post_id` = $post_id";
    $result1 = mysqli_query($conn, $sqlSelect) or die("Query Failed: Select");
    $row = mysqli_fetch_assoc($result1);
    unlink('upload/'.$row['post_img']);


    $sql = "DELETE FROM `post` WHERE `post`.`post_id` = {$post_id};";
    $sql .= "UPDATE `category` SET `category`.`post` = `post`- 1 WHERE `category`.`category_id` = {$cat_id};";

    $result = mysqli_multi_query($conn, $sql) or die("Query Failed!");
    if($result){
        header("Location: {$hostname}post.php");
    }

?>