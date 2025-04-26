<?php 
    include "header.php"; 
    if($_SESSION['user_role'] == "0"){
        header("Location: ".$hostName."admin/post.php");
    }
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
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

                    //   $page_no = $_GET['page'];
                      $offset = ($page_no - 1) * $limit;
                        $sql = "SELECT * FROM `category` LIMIT {$offset}, {$limit}";
                        $result = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($result)>0){
                            $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
                            foreach ($rows as $row) {
                    ?>
                        <tr>
                            <td class='id'><?php echo $row['category_id']; ?></td>
                            <td><?php echo $row['category_name']; ?></td>
                            <td><?php echo $row['post']; ?></td>

                            <td class='edit'><a href='update-category.php?id=<?php echo $row['category_id']; ?>'><i class='fa fa-edit'></i></a></td>

                            <td class='delete'><a href='delete-category.php?id=<?php echo $row['category_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php    
                            }
                        }
                    ?>
                    </tbody>
                </table>
                <ul class='pagination admin-pagination'>
                    <?php 
                    if($page_no > 1){
                            echo '<li><a href="category.php?page='.($page_no - 1).'">Prev</a></li>';
                        }
                ?>
                <?php 
            
                $sql1 = "SELECT * FROM `category`";
                $result = mysqli_query($conn, $sql1) or die("Query Failed!");
                if(mysqli_num_rows($result)>0){

                    $total_record = mysqli_num_rows($result);
                  
                    $total_pages = ceil($total_record/$limit);

                    for($i = 1; $i <= $total_pages; $i++){
                        
                        if($i == $page_no){
                            $active = "active";
                        }else{
                            $active = "";
                        }
                        echo "<li class='{$active}'><a href='category.php?page={$i}'>{$i}</a></li>";
                    }
                }
            
                if($total_pages > $page_no){
                    echo " <li><a href='category.php?page=".($page_no + 1)."'>Next</a></li>";
                }
            ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
