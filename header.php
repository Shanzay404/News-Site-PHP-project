<?php 
// basename function will give us proper file name
    // echo '<h1>'.basename($_SERVER['PHP_SELF']).'</h1>';

    include "db_connect.php";
    $page_name = basename($_SERVER['PHP_SELF']);

    switch ($page_name) {
        case 'single.php':
            if(isset($_GET['id'])){
                $sql_title = "SELECT * FROM `post` WHERE `post`.`post_id` = {$_GET['id']}";
                $result_title = mysqli_query($conn, $sql_title) or die("Query Failed! : title");
                $row_title = mysqli_fetch_assoc($result_title);
                $page_title = $row_title['title'] ." News";
            }else{
                $page_title = "No post Found";
            }
            break;
        case 'post.php':
            if(isset($_GET['id'])){
                $sql_title = "SELECT * FROM `post` WHERE `post`.`post_id` = {$_GET['id']}";
                $result_title = mysqli_query($conn, $sql_title) or die("Query Failed! : title");
                $row_title = mysqli_fetch_assoc($result_title);
                $page_title = $row_title['title']." News";
            }else{
                $page_title = "No post Found";
            }
            break;

        case 'category.php':
            if(isset($_GET['cid'])){
                $sql_title = "SELECT * FROM `category` WHERE `category`.`category_id` = {$_GET['cid']}";
                $result_title = mysqli_query($conn, $sql_title) or die("Query Failed! : title");
                $row_title = mysqli_fetch_assoc($result_title);
                $page_title = $row_title['category_name']." News";
            }else{
                $page_title = "No Category Found";
            }
            break;
        case 'author.php':
            if(isset($_GET['auth_id'])){
                $sql_title = "SELECT * FROM `user` WHERE `user`.`user_id` = {$_GET['auth_id']}";
                $result_title = mysqli_query($conn, $sql_title) or die("Query Failed! : title");
                $row_title = mysqli_fetch_assoc($result_title);
                $page_title = "News By ". $row_title['username'];
            }else{
                $page_title = "No User Found";
            }
        break;
        case 'search.php':
            if(isset($_GET['search'])){
                $page_title = $_GET['search'];
            }else{
                $page_title = "No Search Found";
            }
            break;
            default:
            $page_title = "News Site";
            break;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title; ?></title>
    <script src="css/script.js" defer></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">

               <?php 
                     $sql = "SELECT * FROM `settings`";

                     $result = mysqli_query($conn, $sql);
                     if(mysqli_num_rows($result)>0){
                         while($row = mysqli_fetch_assoc($result)){

                            if($row['web_logo']==""){
                                echo "<a href='index.php'><h1>".$row['web_name']."</h1></a>";
                            }else{
                                echo '<a href="post.php" class="my-auto"><img class="logo" src="admin/upload/'.$row['web_logo'].'" style="height:100px;"></a>';
                            }

                         }
                        }
                ?>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <ul class='menu'>
            <?php 
 
                if(isset($_GET['cid'])){
                    $cat_id = $_GET['cid'];
                }

                include "db_connect.php";
                $sql = "SELECT * FROM `category` WHERE `category`.`post` > 0";
                $result = mysqli_query($conn,$sql) or die("Query Failed: select");
                if(mysqli_num_rows($result)>0){
                    echo "<li><a href='{$hostName}'>Home</a></li>";
                    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    foreach($rows as $row){
                       echo "<li><a href='category.php?cid=".$row['category_id']."'>".$row['category_name']."</a></li>";
                    }
                }

            ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
