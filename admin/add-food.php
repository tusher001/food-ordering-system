<?php 
    ob_start();
    include('partials/menu.php'); 
?>

<div class="main-content">
    <div class="container">
        <h1>Add Food</h1><hr>
        <?php
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>
        <form action="" method="post" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-6">
              <label for="title" class="form-label">Title</label>
              <input type="text" name="title" class="form-control" id="title" placeholder="Enter food title">
            </div>
            <div class="col-md-6">
              <label for="description" class="form-label">Description</label>
              <input type="text" name="description" class="form-control" id="description" placeholder="Enter food description">
            </div>
            <div class="col-md-6">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" class="form-control" id="price" placeholder="Enter food price">
            </div>
            <div class="col-md-6">
              <label for="image" class="form-label">Choose Image</label>
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
                                $id = $row['id'];
                                $title = $row['title'];
                                ?>
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                            }
                        }else{
                            ?>
                            <option value="0">No Category found</option>
                            <?php
                        }
                            ?>
                </select>
            </div>
            <div class="col-md-3">
              <label for="featured" class="form-label">Featured</label><br>
              <input type="radio" name="featured" value="yes">Yes <br>
              <input type="radio" name="featured" value="no">no
            </div>
            <div class="col-md-3">
              <label for="active" class="form-label">Active</label><br>
              <input type="radio" name="active" value="yes">Yes <br>
              <input type="radio" name="active" value="no">No
            </div>
            <div class="col-12 text-center">
              <button type="submit" name="submit" class="btn btn-primary" id="submit">ADD FOOD</button>
            </div>
        </form>

        <?php
            if(isset($_POST['submit'])){
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                
                //check weather img is select or not
                if(isset($_FILES['image']['name'])){
                    $image_name = $_FILES['image']['name'];
                    if($image_name != ''){
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
                            header('location:'.SITEURL.'admin/add-food.php');
                            die();
                        }
                    }
                }
                else{
                    //set default img name value as blank
                    $image_name = "";
                }

                $category = $_POST['category'];
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

                $sql2 = "INSERT INTO `food-order`.`foods` (`title`, `description`, `price`, `img_name`, `category_id`, `featured`, `active`) VALUES ('$title','$description', $price, '$image_name', $category, '$featured', '$active');";
                if($con->query($sql2)==true){      
                    $_SESSION['add'] = '<div class="alert alert-success" role="alert">
                    Food added successfully!
                  </div>';
                    //Redirect page
                    header('location:'.SITEURL.'admin/mng-food.php');
                }
                else{
                    $_SESSION['add'] = '<div class="alert alert-danger" role="alert">
                    Failed to add Food!
                  </div>';
                    //Redirect page
                    header('location:'.SITEURL.'admin/add-food.php');
                }
            }
        ?>

    </div>
</div>

<?php 
    include('partials/footer.php'); 
    ob_end_flush();
?>