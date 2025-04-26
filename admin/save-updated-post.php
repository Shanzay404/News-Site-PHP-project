<?php 
    
    include "db_connect.php";



// Update Image QUERY

    if(empty($_FILES['new-image']['name'])){
        $file_name = $_POST['old-image'];
    }else{
        $errors = array();
        $file_name = $_FILES['new-image']['name'];
        $file_tmp_name = $_FILES['new-image']['tmp_name'];
        $file_type = $_FILES['new-image']['type'];
        $file_size = $_FILES['new-image']['size'];
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



// Updation Code QUERY

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['updatePost'])){
            $post_id = $_POST['post_id'];
            $post_title = mysqli_real_escape_string($conn, $_POST['post_title']);
            $post_description =  mysqli_real_escape_string($conn, $_POST['postdesc']);
            $post_category = $_POST['category'];
            $post_image = $file_name;


            $sql = "UPDATE `post` SET `post`.`title`='{$post_title}',`post`.`description`='{$post_description}', `post`.`category`={$post_category}, `post`.`post_img`='{$post_image}' WHERE `post`.`post_id`='{$post_id}'";
            $result = mysqli_query($conn, $sql) or die("Query Failed");
            if($result){
                header("Location: {$hostname}post.php");
            }else{
                echo "Query Failed!";
            }
        }
    }
?>