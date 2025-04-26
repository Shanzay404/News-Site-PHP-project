<?php 
    include "db_connect.php";

    // code for submitting image (starts)
    if(isset($_FILES['fileToUpload'])){
        $errors = array();
        $file_name = $_FILES['fileToUpload']['name'];
        $file_tmp_name = $_FILES['fileToUpload']['tmp_name'];
        $file_type = $_FILES['fileToUpload']['type'];
        $file_size = $_FILES['fileToUpload']['size'];
        $explode = explode('.', $file_name);
        $file_extension = end($explode);
        $extensions_name = array('jpeg','jpg','png');

        if(in_array($file_extension, $extensions_name) === false){
            $errors[] = 'This Extension file is not allow! Upload file on JPEG, JPG or PNG format';
        }

        if($file_size > 2097152){
            $errors[] =  "File Size Must be 2MB or lower";
        }

        if(empty($errors) == true){
            move_uploaded_file($file_tmp_name,"upload/".$file_name); // Updated this line
        }else{
            print_r($errors);
            die();
        }
    }
    // code for submitting image (ends)

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['submit'])){
            session_start();
            $post_title = mysqli_real_escape_string($conn, $_POST['post_title']);
            $post_desc = mysqli_real_escape_string($conn, $_POST['postdesc']);
            $post_category = mysqli_real_escape_string($conn, $_POST['post_category']);
            $post_date = date('d-m-y');
            // $post_author =  $_SESSION['user_id'];
            $post_author = $_POST['author_id'];

           
            $sql = "INSERT INTO `post` (`title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES ('{$post_title}', '{$post_desc}', '{$post_category}', '{$post_date}', '{$post_author}', '{$file_name}');";
            $sql .= "UPDATE `category` SET post = post + 1 WHERE `category`.`category_id` = {$post_category};";

            
            $result = mysqli_multi_query($conn, $sql) or die("Query Failed: " . mysqli_error($conn)); // Modified this line to provide more error details
            
            if($result){
                header("Location: {$hostname}post.php");
            }else{
                echo "<p class='alert alert-danger'>Query Failed! </p>";
            }
        }
    }
?> 
