<?php 
    include "header.php"; 
 ?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Web Settings</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">





<?php 
    


    $sql = "SELECT * FROM `settings`";

    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_assoc($result)){
?>




        <!-- Form for show edit-->
        <form action="save-updated-settings.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <label for="web_name">Website Name</label>
                <input type="text" name="web_name"  class="form-control" id="web_name" value="<?php echo $row['web_name']; ?>">
            </div>
            <div class="form-group">
                <label for="footer_desc">Footer Description</label>
                <textarea name="footer_desc" class="form-control"  required rows="2" style="text-align: left !important; margin: 0 !important; width: 100% !important; padding: 5px !important; box-sizing: border-box !important;">
                <?php echo $row['footer_desc']; ?>
                </textarea>
                <!-- <textarea name="footer_desc" class="form-control"  required rows="2" style="text-align:starts;"><?php echo $row['footer_desc']; ?></textarea> -->
            </div>
            <div class="form-group">
                <label for="web_logo">Logo</label>
                <input type="file" name="new-logo">
                <img  src="upload/<?php echo $row['web_logo']; ?>" height="80px">
                <input type="hidden" name="old-logo" value="<?php echo $row['web_logo']; ?>">
            </div>
            <input type="submit" name="updateSetting" class="btn btn-primary" value="Update Setting" />
        </form>
        <!-- Form End -->

<?php 
        }
    }
?>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
