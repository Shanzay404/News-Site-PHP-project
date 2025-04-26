<?php 
    include "header.php"; 
    include "db_connect.php"; 

    if($_SESSION['user_role'] == "0"){
        header("Location: ".$hostName."admin/post.php");
    }
?>

  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                    <?php 
                        $limit = 3;

                        if(isset($_GET['page'])){
                            $page_no = $_GET['page'];
                        }else{
                            $page_no = 1;
                        }

                        $offset = ($page_no - 1) * $limit;
                      
                        $sql = "SELECT * FROM `user` LIMIT {$offset}, {$limit}";

                        $result = mysqli_query($conn, $sql) or die("Query Failed");

                        $sno = 0;
                        if(mysqli_num_rows($result)>0){
                            while($row = mysqli_fetch_assoc($result)){
                                $sno++;
                                $id = $row['user_id'];
                                $first_name = $row['first_name'];
                                $last_name = $row['last_name'];
                                $username = $row['username'];
                                $role = $row['role'];



                                echo "<tr>
                                            <td class='id'>".$sno."</td>
                                            <td>".$first_name." ".$last_name."</td>
                                            <td>".$username."</td>
                                            <td>"?>
                                            <?php 
                                                if($role == '1'){
                                                    echo "admin";
                                                }
                                                else{
                                                    echo "user";
                                                }
                                            ?>
                                            <?php 
                                            echo "</td>
                                            <td class='edit'><a href='update-user.php?id=".$id."'><i class='fa fa-edit'></i></a></td>
                                            <td class='delete'><a href='delete-user.php?id=".$id."'><i class='fa fa-trash-o'></i></a></td>
                                     </tr>";
                            }
                        }
                        else{
                            echo "<h2> No Records Found! </h2>";
                        }
                          
                    ?>
                          
                      </tbody>
                  </table>


                  <?php 
                    
                    
                    $sql1 = "SELECT * FROM `user`";
                    $result1 = mysqli_query($conn, $sql1) or die("query Failed!");

                    if(mysqli_num_rows($result1) > 0){

                        $total_records = mysqli_num_rows($result1);
                        $total_pages = ceil($total_records/$limit);

                        echo " <ul class='pagination admin-pagination'>";
                        if($page_no > 1){
                            echo " <li><a href='users.php?page=".($page_no - 1)."'>Prev</a></li>";
                        }
                        for($i = 1; $i <= $total_pages; $i++){
                            if($i == $page_no){
                                $active = "active";
                            }else{
                                $active = "";
                            }
                            echo "<li class='".$active."'><a href='users.php?page=".$i."'>".$i."</a></li>";
                        }
                        if($total_pages > $page_no){
                            echo " <li><a href='users.php?page=".($page_no + 1)."'>Next</a></li>";
                        }
                        // echo " <li><a 'users.php?page=".($page_no + 1)."'>Next</a></li>";
                        echo "</ul>";

                    }




                  ?>
                 
<!--                       
                      <li><a>2</a></li>
                      <li><a>3</a></li> -->
                  
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
