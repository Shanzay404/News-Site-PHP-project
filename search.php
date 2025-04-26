<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                     <?php 

                     if(isset($_GET['search'])){
                        $search = $_GET['search'];
                      }

                        
                    ?>
                <h2 class="page-heading">Search: <?php echo $search; ?></h2>


                    <?php 

                    if(isset($_GET['page'])){
                        $page_no = $_GET['page'];
                    }else{
                        $page_no = 1;
                    }

                    $limit = 3;
                    $offset = ($page_no - 1) * $limit;


                        $sql = "SELECT * FROM `post` LEFT JOIN `category` ON `post`.`category` = `category`.`category_id` LEFT JOIN `user` ON `post`.`author` = `user`.`user_id` WHERE `post`.`title` LIKE '%$search%' OR `post`.`description` LIKE '%$search%'  ORDER BY `post`.`post_id` DESC limit $offset, $limit";

                        $result = mysqli_query($conn, $sql) or die("Query Failed!");

                        if(mysqli_num_rows($result)>0){
                            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            foreach ($rows as $row) {
                        
                    ?>

                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $row['post_id']; ?>"> 
                                    <img src="admin/upload/<?php echo $row['post_img']; ?>" alt="" style="height:100%;"/>
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix" style="text-align: start;">
                                        <h3><a href='single.php?id=<?php echo $row['post_id']; ?>'><?php echo $row['title']; ?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?cid=<?php echo $row['category_id']; ?>'><?php echo $row['category_name']; ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                   <a href='author.php?search=<?php echo $row['author']; ?>'><?php echo $row['username']; ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row['post_date']; ?>
                                            </span>
                                        </div>
                                        <p class="description">
                                        <?php echo substr($row['description'], 0, 130); ?>...
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']; ?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <ul class='pagination'>
                    <?php
                        }

                    }

                    $sql1 = "SELECT * FROM `post` WHERE `post`.`title` LIKE '%$search%' OR `post`.`description` LIKE '%$search%' ";
                        $result1 = mysqli_query($conn, $sql1) or die('Query Failed');
                        $row1 = mysqli_fetch_assoc($result1);

                    if($page_no > 1){
                        echo "<li><a href='search.php?search=".$search."&page=".($page_no-1)."'>Prev</a></li>";
                    }
                    


                    if(mysqli_num_rows($result1)>0){

                        $total_records = mysqli_num_rows($result1);
                    
                        $total_pages = ceil($total_records / $limit);

                        for($i=1; $i <= $total_pages; $i++) {
                            if($page_no == $i){
                                $active = "active";
                            }else{
                                $active = "";
                            }
                            echo "<li class='$active'><a href='search.php?search=".$search."&page=".$i."'>".$i."</a></li>";
                        }

                        if($page_no < $total_pages){
                        echo "<li><a href='search.php?search=".$search."&page=".($page_no+1)."'>Next</a></li>";
                        }

                    }






                    ?>

                        </ul>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
