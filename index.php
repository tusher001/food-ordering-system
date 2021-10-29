<?php include('partials-front/menu.php'); ?>
    <!-- Heading -->
    <div id="home" class="d-flex align-items-center">
        <div class="container row justify-content-end">
            <div class="col-md-6">
                <p><strong>WIDE OPTION OF CHOICE</strong></p>
                <h1>Delicious Recipes</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci, consectetur natus in, magni molestias enim dolor expedita reprehenderit quos quasi.</p>
                <a class="btn org-btn" href="foods.php">CHECK OUR MENU</a><br><br>
                <?php
                  if(isset($_SESSION['order'])){
                    echo $_SESSION['order'];
                    unset($_SESSION['order']);
                  }
                ?>
            </div>
        </div>
    </div>

    <!-- Categories -->
    <div id="categories" class="my-5">
        <div class="container">
            <h1 class="mb-5" style="text-align: center;">Explore Foods</h1>

            <div class="row row-cols-1 row-cols-md-3 g-4">
              <?php
                $sql = "SELECT * FROM category WHERE category.active='yes' AND category.featured='yes' LIMIT 3";
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
    </div>

    <!-- Food list -->
    <div id="food" class="py-5">
        <div class="container">
            <h1 class="mb-5" style="text-align: center;">Food Menu</h1>

            <div class="row row-cols-1 row-cols-md-2 g-4">

              <?php

                $sql2 = "SELECT * FROM foods WHERE foods.active='yes' AND foods.featured='yes' LIMIT 6";
                $res2 = mysqli_query($con,$sql2);
                $count2 = mysqli_num_rows($res2);
                if($count2>0){
                  while($row=mysqli_fetch_assoc($res2)){
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $img_name = $row['img_name'];
                    ?>

                      <div class="col">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                  <?php
                                    if($img_name == ""){
                                      echo "<div class='alert alert-danger' role='alert'>
                                        Image not available!
                                      </div>";
                                    }
                                    else{
                                      ?>

                                      <img src="<?php echo SITEURL; ?>/img/food/<?php echo $img_name; ?>" class="img-fluid rounded-start" alt="...">
                                      
                                      <?php
                                    }
                                  ?>
                                    
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $title; ?></h5>
                                        <h5 class="food-price"><?php echo $price; ?>/-</h5>
                                        <p class="card-text text-muted"><?php echo $description; ?></p>
                                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn org-btn">Order Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    
                    <?php
                  }
                }
                else{
                  echo "<div class='alert alert-danger' role='alert'>
                  No foods available!
                </div>";
                }

              ?>

            </div>

            <div class="d-flex justify-content-center mt-4 full-menu">
              <a href="foods.php">See Full Menu</a>
            </div>
            
        </div>
    </div>

    <?php include('partials-front/footer.php'); ?>