<?php include('partials-front/menu.php'); ?>

<?php
    if(isset($_GET['category_id'])){
        $category_id = $_GET['category_id'];
        $sql  = "SELECT title FROM category WHERE id='$category_id'";
        $res = mysqli_query($con,$sql);
        $row=mysqli_fetch_assoc($res);
        $category_title = $row['title'];
    }
    else{
        header('location:'.SITEURL);
    }
?>

    <!-- Food list -->
    <div id="food" style="margin-top: 74px;" class="py-5">
        <div class="container">
            <h1 class="mb-4" style="text-align: center;">List of <span style="color: rgb(244,47,44);">"<?php echo $category_title; ?>"</span></h1>

            <div class="row row-cols-1 row-cols-md-2 g-4">

            <?php

                $sql2 = "SELECT * FROM foods WHERE foods.category_id='$category_id'";
                $res2 = mysqli_query($con,$sql2);
                $count = mysqli_num_rows($res2);
                if($count>0){
                    while($row2=mysqli_fetch_assoc($res2)){
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $description = $row2['description'];
                        $price = $row2['price'];
                        $img_name = $row2['img_name'];
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
