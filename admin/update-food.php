<?php
  ob_start();
  include('partials/menu.php'); 
?>

<div class="main-content">
    <div class="container">
        <h1>Update Food</h1><hr>
        <?php
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <?php
          $id = $_GET['id'];
          $sql2 = "SELECT * FROM foods WHERE foods.id=$id";
          $res2 = mysqli_query($con,$sql2);
          if($res2 == true){
            $count = mysqli_num_rows($res2);
            if($count == 1){
              $row2 = mysqli_fetch_assoc($res2);
              $title = $row2['title'];
              $description = $row2['description'];
              $price = $row2['price'];
              $current_image = $row2['img_name'];
              $current_category = $row2['category_id'];
              $featured = $row2['featured'];
              $active = $row2['active'];
            }else{
              header('location:'.SITEURL.'admin/mng-category.php');
            }
          }
        ?>
        <form action="" method="post" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-6">
              <label for="title" class="form-label">Title</label>
              <input type="text" name="title" class="form-control" id="title" value="<?php echo $title; ?>">
            </div>
            <div class="col-md-6">
              <label for="description" class="form-label">Description</label>
              <input type="text" name="description" class="form-control" id="description" value="<?php echo $description; ?>">
            </div>
            <div class="col-md-6">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" class="form-control" id="price" value="<?php echo $price; ?>">
            </div>
            <div class="col-md-6">
              <label for="image" class="form-label">Current Image</label>
              <?php
                if($current_image != ''){
                    ?>
                    <img src="<?php echo SITEURL; ?>img/food/<?php echo $current_image; ?>" width="100px">
                    <?php
                }
                else{
                    echo "Image not added";
                }
              ?>
            </div>
            <div class="col-md-6">
              <label for="image" class="form-label">Choose New Image</label>
              <input type="file" name="image" class="form-control" id="image">
            </div>
            <div class="col-md-6">
                <label for="category" class="form-label">Choose category</label>
                <select name="category" class="form-control">
                    <?php
                        //php code to display category from our database
                        $sql = "SELECT * FROM `category` WHERE category.active='yes'";
                        $res = mysqli_query($con,$sql);
                        $count = mysqli_num_rows($res);
                        if($count>0){
                            while($row=mysqli_fetch_assoc($res)){
                                $category_id = $row['id'];
                                $category_title = $row['title'];
                                // echo "<option value='$category_id'>$category_title</option>";
                                ?>
                                <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                <?php
                            }
                        }else{
                             echo '<option value="0">No Category found</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-3">
              <label for="featured" class="form-label">Featured</label><br>
              <input <?php if($featured=='yes'){echo 'checked';} ?> type="radio" name="featured" value="yes">Yes <br>
              <input <?php if($featured=='no'){echo 'checked';} ?> type="radio" name="featured" value="no">No
            </div>
            <div class="col-md-3">
              <label for="active" class="form-label">Active</label><br>
              <input <?php if($active=='yes'){echo 'checked';} ?> type="radio" name="active" value="yes">Yes <br>
              <input <?php if($active=='no'){echo 'checked';} ?> type="radio" name="active" value="no">No
            </div>
            <div class="col-12 text-center">
              <input type="hidden" name="current_img" value="<?php echo $current_image; ?>">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <button type="submit" name="submit" class="btn btn-primary" id="submit">UPDATE</button>
            </div>
        </form>

        <?php
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_img = $_POST['current_img'];
                $category = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                
                //updating image
                if(isset($_FILES['image']['name'])){
                    $image_name = $_FILES['image']['name'];

                    if($image_name != ""){
                        //getting the extension of the img
                        $sample = explode(".",$image_name);
                        $ext = end($sample);
                        //rename the image
                        $image_name = "Food_Name_".rand(000,999).".".$ext;

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../img/food/".$image_name;

                        $upload = move_uploaded_file($source_path,$destination_path);
                        if($upload == false){
                            $_SESSION['upload'] = '<div class="alert alert-danger" role="alert">
                            Failed to upload image!
                            </div>';
                            //Redirect page
                            header('location:'.SITEURL.'admin/mng-food.php');
                            die();
                        }

                        if($current_img != ''){
                            //remove the current img
                            $remove_path = "../img/food/".$current_img;
                            $remove = unlink($remove_path);
                            if($remove==false){
                                $_SESSION['failed-remove'] = '<div class="alert alert-danger" role="alert">
                                Failed to remove current image!
                                </div>';
                                header('location:'.SITEURL.'admin/mng-food.php');
                                die();
                            }
                        }
                    }
                    else{
                        $image_name = $current_img;
                    }
                }
                else{
                    //set default img name value as blank
                    $image_name = $current_img;
                }

                //updating database
                $sql3 = "UPDATE foods SET title='$title', description='$description', price=$price, img_name='$image_name', category_id='$category', featured='$featured',active='$active' WHERE id='$id'";
                if($con->query($sql3)==true){      
                    $_SESSION['update'] = '<div class="alert alert-success" role="alert">
                    Food updated successfully!
                  </div>';
                    //Redirect page
                    header('location:'.SITEURL.'admin/mng-food.php');
                }
                else{
                    $_SESSION['update'] = '<div class="alert alert-danger" role="alert">
                    Failed to update food!
                  </div>';
                    //Redirect page
                    header('location:'.SITEURL.'admin/update-food.php');
                }
            }
        ?>

    </div>
</div>

<?php 
  include('partials/footer.php'); 
  ob_end_flush();
?>