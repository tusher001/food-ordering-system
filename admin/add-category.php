<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="container">
        <h1>Add Category</h1><hr>
        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];//displaying session message
                unset($_SESSION['add']);//removing session message
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];//displaying session message
                unset($_SESSION['upload']);//removing session message
            }
        ?>
        <form action="" method="post" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-12">
              <label for="title" class="form-label">Title</label>
              <input type="text" name="title" class="form-control" id="title" placeholder="Enter category title">
            </div>
            <div class="col-md-12">
              <label for="image" class="form-label">Choose Image</label>
              <input type="file" name="image" class="form-control" id="image">
            </div>
            <div class="col-md-12">
              <label for="featured" class="form-label">Featured</label><br>
              <input type="radio" name="featured" value="yes">Yes <br>
              <input type="radio" name="featured" value="no">no
            </div>
            <div class="col-md-12">
              <label for="active" class="form-label">Active</label><br>
              <input type="radio" name="active" value="yes">Yes <br>
              <input type="radio" name="active" value="no">No
            </div>
            <div class="col-12 text-center">
              <button type="submit" name="submit" class="btn btn-primary" id="submit">Add category</button>
            </div>
        </form>

        <?php
            if(isset($_POST['submit'])){
                $title = $_POST['title'];
                if(isset($_POST['featured'])){
                    $featured = $_POST['featured'];
                }else{
                    //set the default value no
                    $featured = 'no';
                }
                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                }else{
                    //set the default value no
                    $active = 'no';
                }
                //check weather img is select or not
                if(isset($_FILES['image']['name'])){
                    $image_name = $_FILES['image']['name'];
                    //getting the extension of the img
                    $ext = end(explode(".",$image_name));
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
                    header('location:'.SITEURL.'admin/add-category.php');
                    die();
                    }
                }
                else{
                    //set default img name value as blank
                    $image_name = "";
                }

                $sql = "INSERT INTO `food-order`.`category` (`title`, `img_name`, `featured`, `active`) VALUES ('$title', '$image_name', '$featured', '$active');";
                if($con->query($sql)==true){      
                    $_SESSION['add'] = '<div class="alert alert-success" role="alert">
                    Category added successfully!
                  </div>';
                    //Redirect page
                    header('location:'.SITEURL.'admin/mng-category.php');
                }
                else{
                    $_SESSION['add'] = '<div class="alert alert-danger" role="alert">
                    Failed to add category!
                  </div>';
                    //Redirect page
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>