<?php 
    include "header.php"; 
    include "db_connect.php"; 
    if($_SESSION['user_role'] == "0"){
        header("Location: ".$hostName."admin/post.php");
    }


    // update code starts
   
    if(isset( $_POST['submit'])){

    
        $userId = mysqli_real_escape_string($conn, $_POST['user_id']);
        $fname = mysqli_real_escape_string($conn, $_POST['f_name']);
        $lname = mysqli_real_escape_string($conn, $_POST['l_name']);
        $user = mysqli_real_escape_string($conn, $_POST['username']);
        $role = mysqli_real_escape_string($conn, $_POST['role']);


        
        // $checkSql = "SELECT * FROM `user` WHERE `username` = '{$user}'";
        // $resultCheck = mysqli_query($conn, $checkSql);

        // if(mysqli_num_rows($resultCheck) > 0){
        //     echo "<p style='color: red;'>Username already exists! try another username</p>";
        //     die();
        // }
        // else{
            $sql = "UPDATE `user` SET `first_name` = '{$fname}', `last_name` = '{$lname}',  `role` = '{$role}' WHERE `user`.`user_id` = '{$userId}'";

             $result = mysqli_query($conn, $sql) or die ("Query Failed");

            //  $sql2 = "INSERT INTO `user` (`first_name`, `last_name`, `username`, `password`, `role`) VALUES ('{$fname}', '{$lname}', '{$user}', '{$password}', '{$role}')";  
          
             if(mysqli_query($conn, $sql)){
              header("Location: ".$hostName."admin/users.php");
             }
        // }
    }
   


    // update code ends 
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">



              <!-- Edit Code starts -->
              <?php 
                
                        $user_id = $_GET['id'];

                        $sql = "SELECT * FROM `user` WHERE user_id = '{$user_id}'";
                        $result = mysqli_query($conn, $sql) or die("Query Failed!");

                        if(mysqli_num_rows($result)>0){
                            while($row = mysqli_fetch_assoc($result)){
                                $userId = $user_id;
                                $first_name = $row['first_name'];
                                $last_name = $row['last_name'];
                                $username = $row['username'];
                                $role = $row['role'];


                echo "<form  action='".$_SERVER['PHP_SELF']."' method ='POST'>
                        <div class='form-group'>
                            <input type='hidden' name='user_id'  class='form-control' 
                            value='".$userId."' placeholder='' >
                        </div>
                            <div class='form-group'>
                            <label>First Name</label>
                            <input type='text' name='f_name' class='form-control' 
                            value='".$first_name."' placeholder='' required>
                        </div>
                        <div class='form-group'>
                            <label>Last Name</label>
                            <input type='text' name='l_name' class='form-control' 
                            value='".$last_name."' placeholder='' required>
                        </div>
                        <div class='form-group'>
                            <label>User Name</label>
                            <input type='text' name='username' disabled class='form-control' id='username'
                            value='".$username."' placeholder='' required' style='cursor: not-allowed';> 
                        </div>
                        <div class='form-group'>
                            <label>User Role</label>
                            <select class='form-control' name='role' value='".$role."'> "?>
                            <?php 
                                if($role == '0'){
                                    echo "<option value='0' selected >normal User</option>
                                          <option value='1' >Admin</option>";
                                }
                                else{
                                    echo "<option value='0' > normal User</option>
                                          <option value='1' selected >Admin</option>";
                                }
                            ?>
                            <?php echo "
                            </select>
                        </div>
                        <input type='submit' name='submit' class='btn btn-primary' value='Update' required />
                    </form>";

                            }
                        }

                

                
                
                
                
                ?>
                <!-- Edit Code ends -->


                  <!-- Form Start -->
              
                  
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
 
<?php include "footer.php"; ?>
