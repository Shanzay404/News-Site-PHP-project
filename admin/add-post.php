<?php 
    include "header.php"; 
 
?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Add New Post</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">

                  <!-- Form -->
                  <form  action="save-post.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Title</label>
                          <input type="hidden" name="author_id" value="<?php echo $_SESSION['user_id']; ?>" class="form-control" autocomplete="off" >
                          <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1"> Description</label>
                          <textarea name="postdesc" class="form-control" rows="5"  required></textarea>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Category</label>
                          <select name="post_category" class="form-control">
                              <option disabled> Select Category</option>

     <?php     

        include "db_connect.php";
                              
        $sql = "SELECT * FROM `category`";
                               
        $result = mysqli_query($conn, $sql) or die("Query Failed");

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $cat_id = $row['category_id'];
                $cat_name = $row['category_name'];

                    echo "<option value='".$cat_id."'>".$cat_name."</option>";
            }
        }
        ?>

                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" name="fileToUpload" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
