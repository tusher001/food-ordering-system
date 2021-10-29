<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="container">
        <h1>Update Category</h1><hr>
        <?php
          $id = $_GET['id'];
          $sql = "SELECT * FROM category WHERE category.id=$id";
          $res = mysqli_query($con,$sql);
          if($res == true){
            $count = mysqli_num_rows($res);
            if($count == 1){
              $row = mysqli_fetch_assoc($res);
              $title = $row['title'];
              $img_name = $row['img_name'];
              $featured = $row['featured'];
              $active = $row['active'];
            }else{
              header('location:'.SITEURL.'admin/mng-category.php');
            }
          }
        ?>
        <form action="" method="post" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-12">
              <label for="title" class="form-label">Title</label>
              <input type="text" name="title" class="form-control" id="title" value="<?php echo $title ?>">
            </div>
            <div class="col-md-12">
              <label class="form-label">Current Image</label><br>
              <?php
                if($img_name != ''){
                    ?>
                    <img src="<?php echo SITEURL; ?>img/category/<?php echo $img_name; ?>" width="100px">
                    <?php
                }
                else{
                    echo "Image not added";
                }
              ?>
            </div>
            <div class="col-md-12">
              <label for="image" class="form-label">New Image</label>
              <input type="file" name="image" class="form-control" id="image">
            </div>
            <div class="col-md-12">
              <label for="featured" class="form-label">Featured</label><br>
              <input <?php if($featured=='yes'){echo 'checked';} ?> type="radio" name="featured" value="yes">Yes <br>
              <input <?php if($featured=='no'){echo 'checked';} ?> type="radio" name="featured" value="no">no
            </div>
            <div class="col-md-12">
              <label for="active" class="form-label">Active</label><br>
              <input <?php if($active=='yes'){echo 'checked';} ?> type="radio" name="active" value="yes">Yes <br>
              <input <?php if($active=='no'){echo 'checked';} ?> type="radio" name="active" value="no">No
            </div>
            <div class="col-12 text-center">
              <input type="hidden" name="current_img" value="<?php echo $img_name; ?>">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <button type="submit" name="submit" class="btn btn-primary" id="submit">Update category</button>
            </div>
        </form>

        <?php
            if(isset($_POST['submit'])){
                $title = $_POST['title'];
                $current_img = $_POST['current_img'];
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
                        $image_name = "Food_category_".rand(000,999).".".$ext;

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../img/category/".$image_name;

                        $upload = move_uploaded_file($source_path,$destination_path);
                        if($upload == false){
                            $_SESSION['upload'] = '<div class="alert alert-danger" role="alert">
                            Failed to upload image!
                            </div>';
                            //Redirect page
                            header('location:'.SITEURL.'admin/mng-category.php');
                            die();
                        }
                        if($current_img != ''){
                            //remove the current img
                            $remove_path = "../img/category/".$current_img;
                            $remove = unlink($remove_path);
                            if($remove==false){
                                $_SESSION['failed-remove'] = '<div class="alert alert-danger" role="alert">
                                Failed to remove current image!
                                </div>';
                                header('location:'.SITEURL.'admin/mng-category.php');
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
                $sql2 = "UPDATE category SET title='$title', img_name='$image_name', featured='$featured',active='$active' WHERE id='$id'";
                if($con->query($sql2)==true){      
                    $_SESSION['update'] = '<div class="alert alert-success" role="alert">
                    Category updated successfully!
                  </div>';
                    //Redirect page
                    header('location:'.SITEURL.'admin/mng-category.php');
                }
                else{
                    $_SESSION['update'] = '<div class="alert alert-danger" role="alert">
                    Failed to update category!
                  </div>';
                    //Redirect page
                    header('location:'.SITEURL.'admin/update-category.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>