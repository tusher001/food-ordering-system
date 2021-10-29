<?php include('partials-front/menu.php'); ?>

<div id="categories" style="margin-top: 100px !important;">
        <div class="container">
            <h1 class="mb-5" style="text-align: center;">Explore Foods</h1>

            <div class="row row-cols-1 row-cols-md-3 g-4 pb-5">
            <?php
              $sql = "SELECT * FROM category WHERE category.active='yes'";
              $res = mysqli_query($con,$sql);
              $count = mysqli_num_rows($res);
              if($count>0){
                while($row=mysqli_fetch_assoc($res)){
                    $id = $row['id'];
                    $title = $row['title'];
                    $img_name = $row['img_name'];
                    ?>
                    <div class="col">
                      <div class="card">
                        <?php 
                          if($img_name == ""){
                            echo "<div class='alert alert-danger' role='alert'>
                            Image not available!
                          </div>";
                          }
                          else{
                            ?>

                            <img src="<?php echo SITEURL; ?>/img/category/<?php echo $img_name; ?>" class="card-img-top" alt="...">

                            <?php
                          }
                        ?>
                        <div class="card-body">
                          <h5 class="card-title"><?php echo $title; ?></h5>
                          <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id ?>" class="btn org-btn">See more</a>
                        </div>
                      </div>
                    </div>
                    <?php
                }
              }
              else{
                echo "<div class='alert alert-danger' role='alert'>
                  No category available!
                </div>";
              }
            ?>
          </div>
        </div>

<?php include('partials-front/footer.php'); ?>