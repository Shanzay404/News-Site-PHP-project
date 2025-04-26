

<?php 
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "news-site";

    $conn = mysqli_connect($servername, $username, $password, $database) or die ("connection failed". mysqli_connect_error());


    $hostName = "http://localhost/php-projects/news-site/";

?>