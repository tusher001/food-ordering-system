<?php include('partials-front/menu.php'); ?>

    <!-- Food list -->
    <div id="food" style="margin-top: 74px;" class="py-5">
        <div class="container">
            <h1 class="mb-4" style="text-align: center;">Food Menu</h1>

            <div class="row row-cols-1 row-cols-md-2 g-4">

            <?php

                $sql = "SELECT * FROM foods WHERE foods.active='yes'";
                $res = mysqli_query($con,$sql);
                $count = mysqli_num_rows($res);
                if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
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
              <a href="foods.php">View more</a>
            </div>
            
        </div>
    </div>
    <?php include('partials-front/footer.php'); ?>
