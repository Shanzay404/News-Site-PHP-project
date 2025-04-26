<?php 
    include "header.php";
    if($_SESSION['user_role'] == "0"){
        header("Location: ".$hostName."admin/post.php");
    }

    // updation code

    if(isset($_POST['update'])){
        $category_id = $_POST['category_id'];
        $category_name = $_POST['category_name'];

        $sql1 = "UPDATE `category` SET`category_name` = '{$category_name}' WHERE `category`.`category_id` = {$category_id}";
        $result1 = mysqli_query($conn, $sql1) or die("Query Failed!");
        if($result1){
            header("Location: {$hostname}category.php");
        }
    }



 ?>



  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">


            <?php 
                
                $cat_id = $_GET['id'];

                $selectSql = "SELECT * FROM `category` WHERE `category`.`category_id` = {$cat_id}";
                $result = mysqli_query($conn, $selectSql) or die("Query Failed!");
                if(mysqli_num_rows($result)>0){
                    $row = mysqli_fetch_assoc($result);

                    $cat_id = $row['category_id'];
                    $cat_name = $row['category_name'];



                }

            ?>



                  <form action="" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="category_id"  class="form-control" value="<?php echo $cat_id; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="category_name" class="form-control" value="<?php echo $cat_name; ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="update" class="btn btn-primary" value="Update" required />
                  </form>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
