<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <?php 
                     $sql = "SELECT * FROM `settings`";

                     $result = mysqli_query($conn, $sql);
                     if(mysqli_num_rows($result)>0){
                         while($row = mysqli_fetch_assoc($result)){

                           echo '<span>'.$row['footer_desc'].'</span>';

                         }
                        }
                ?>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
