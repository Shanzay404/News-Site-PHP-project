<?php 
    
    include "db_connect.php";



// Update Image QUERY

    if(empty($_FILES['new-logo']['name'])){
        $file_name = $_POST['old-logo'];
    }else{
        $errors = array();
        $file_name = $_FILES['new-logo']['name'];
        $file_tmp_name = $_FILES['new-logo']['tmp_name'];
        $file_type = $_FILES['new-logo']['type'];
        $file_size = $_FILES['new-logo']['size'];
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

        if(isset($_POST['updateSetting'])){
            $website_name = mysqli_real_escape_string($conn, $_POST['web_name']);
            $footer_description =  mysqli_real_escape_string($conn, $_POST['footer_desc']);
            $website_logo = $file_name;


            $sql = "UPDATE `settings` SET `settings`.`web_name`='{$website_name}',`settings`.`footer_desc`='{$footer_description}',`settings`.`web_logo`='{$website_logo}'";
            $result = mysqli_query($conn, $sql) or die("Query Failed");
            if($result){
                header("Location: {$hostname}settings.php");
            }else{
                echo "Query Failed!";
            }
        }
    
?>