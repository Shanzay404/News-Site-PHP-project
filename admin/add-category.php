<?php 
    include "header.php";
    if($_SESSION['user_role'] == "0"){
        header("Location: ".$hostName."admin/post.php");
    }
 ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">

                <?php 
                    
                    if(isset($_POST['save'])){
                        $category = $_POST['category_name'];

                        $sql = "INSERT INTO `category` (`category_name`) VALUES ('$category')";
                        $result = mysqli_query($conn, $sql) or die("Query Failed!");
                        if($result){
                            header("Location: {$hostname}category.php");
                        }
                    }


                ?>



                  <!-- Form Start -->
                  <form action="" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="category_name" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
