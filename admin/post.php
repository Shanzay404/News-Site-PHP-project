<?php 
    include "header.php"; 
    include "db_connect.php"; 
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Post Title</th>
                          <th>Category</th>
                          <th>Post Id</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>

                    <?php 

                        if(isset($_GET['page'])){
                            $page_no = $_GET['page'];
                        }else{
                            $page_no = 1;
                        }
                                                
                        $limit = 3;
                        $offset = ($page_no - 1) * $limit;


                    if($_SESSION['user_role'] == "1")     //  admin 
                    {    
                        $sql = "SELECT  `post`.`post_id`, `post`.`title`,`post`.`description`, `post`.`post_date`, `post`.`category`, `category`.`category_name`, `user`.`username` FROM `post` 
                        LEFT JOIN `category` ON `post`.`category` = `category`.`category_id` LEFT JOIN `user` ON `post`.`author` = `user`.`user_id` ORDER BY post_id DESC LIMIT {$offset}, {$limit}";

                    }
                    elseif($_SESSION['user_role'] == "0")   // user
                    {  
                        $sql = "SELECT  `post`.`post_id`, `post`.`title`,`post`.`author`,`post`.`description`, `post`.`post_date`, `post`.`category`, `category`.`category_name`, `user`.`username` FROM `post` 
                        LEFT JOIN `category` ON `post`.`category` = `category`.`category_id` LEFT JOIN `user` ON `post`.`author` = `user`.`user_id` WHERE `post`.`author` = '{$_SESSION['user_id']}' ORDER BY post_id DESC LIMIT {$offset}, {$limit} ";
                    }

                $result = mysqli_query($conn, $sql) or die("Query Failed!");

                $sno = 0;
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        $sno++;
                        $post_id = $row['post_id'];
                        $post_title = $row['title'];
                        $post_description = $row['description'];
                        $post_category = $row['category'];
                        $post_category_name = $row['category_name'];
                        $post_date = $row['post_date'];
                        // $post_author = $row['author'];
                        $post_author_name = $row['username'];
                        // $post_img = $row['post_img'];


                        echo "<tr>
                              <td class='id'>".$sno."</td>
                              <td>".$post_title."</td>
                              <td>".$post_category_name."</td>
                              <td>".$post_id."</td>
                              <td>".$post_date."</td>
                              <td>".$post_author_name."</td>
                              <td class='edit'><a href='update-post.php?id=".$post_id."'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?post_id=".$post_id."&cat_id={$post_category}'><i class='fa fa-trash-o'></i></a></td>
                          </tr>";
                    }
                }else{
                    echo "<h3> No Records Found! </h3>";
                }

                    ?>

                      </tbody>
                  </table>

                  <ul class='pagination admin-pagination'>

                <?php 
                    if($page_no > 1){
                        echo "<li><a href='post.php?page=".($page_no - 1)."'>Prev</a></li>";
                    }

                  $sql1 = "SELECT * FROM `post`";
                  $result1 = mysqli_query($conn, $sql1) or die("Query Failed: Pagination");

                  if($row = mysqli_num_rows($result1)){
                    $total_records = mysqli_num_rows($result1);
                   
                    $total_pages = ceil($total_records/$limit);
                    for($i=1; $i<=$total_pages; $i++){

                        if($i == $page_no){
                            $active = "active";
                        }else{
                            $active = "";
                        }
                    echo    "<li class=".$active."><a href='post.php?page=".$i."'>".$i."</a></li>";
                    }
                  }

                  if($total_pages > $page_no){
                    echo "<li><a href='post.php?page=".($page_no + 1)."'>Next</a></li>";
                  }
                  ?>

                  </ul>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
