<?php include('partials/menu.php'); ?>

    <!-- main content -->
    <div class="main-content">
        <div class="container">
        <?php
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
        ?>
            <h1 class="mb-3">Dashboard</h1>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <div class="col">
                  <div class="card h-100 py-3">
                    <div class="card-body">
                      <?php
                        $sql = "SELECT * FROM `category`" ;
                        $res = mysqli_query($con, $sql);
                        $count = mysqli_num_rows($res);
                      ?>
                      <h2 class="card-title"><?php echo $count; ?></h2>
                      <p class="card-text">Categories</p>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card h-100 py-3">
                    <div class="card-body">
                      <?php
                        $sql2 = "SELECT * FROM `foods`" ;
                        $res2 = mysqli_query($con, $sql2);
                        $count2 = mysqli_num_rows($res2);
                      ?>
                      <h2 class="card-title"><?php echo $count2; ?></h2>
                      <p class="card-text">Foods</p>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card h-100 py-3">
                    <div class="card-body">
                      <?php
                        $sql3 = "SELECT * FROM `t_order`" ;
                        $res3 = mysqli_query($con, $sql3);
                        $count3 = mysqli_num_rows($res3);
                      ?>
                      <h2 class="card-title"><?php echo $count3; ?></h2>
                      <p class="card-text">Total Orders</p>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card h-100 py-3">
                    <div class="card-body">
                      <?php
                        $sql4 = "SELECT SUM(total) AS Total FROM `t_order` WHERE status='Delivered'";
                        $res4 = mysqli_query($con, $sql4);
                        $row4 = mysqli_fetch_assoc($res4);
                        $total_revenue = $row4['Total'];
                      ?>
                      <h2 class="card-title"><?php echo $total_revenue; ?>/-</h2>
                      <p class="card-text">Revenue Generated</p>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>

<?php include('partials/footer.php'); ?>