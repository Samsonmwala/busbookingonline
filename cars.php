<?php 
include('conn.php');
include('functions.php');
?>
<!DOCTYPE html>
<html lang="en">

<?php
  include('header.php');
  
 ?>

<body class="">
  <div class="wrapper ">
    

<?php include('sidebar.php')?>



    <div class="main-panel">
      <!-- Navbar -->
      
   <?php include('nav.php');?>
      <!-- End Navbar -->
      <!-- <div class="panel-header panel-header-sm">


</div> -->
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-user">
              <div class="card-header">
                <div class="update ml-auto mr-auto">
                    
                      
                     <a href="allcars.php"> <button   class="btn btn-success "><i class="fa fa-list"></i> All Vehicle</button></a>
                   
                  
                    <hr>
                  </div>
              </div>
             
              <div class="card-footer">
                
                <div class="button-container">
                  <div class="row">
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title">Add Vehicle Details</h5>
              </div>

              <hr>
              <div class="card-body">

                 <?php 
                  if(isset($_SESSION['loginerror'])){
                    echo $_SESSION['loginerror'];
                    unset($_SESSION['loginerror']);

                  }
                  ?>

                <form method="post" role="form" action="functions.php" >
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Registration number</label>
                        <input type="text" name="vehiclereg" class="form-control" placeholder="Enter Vehicle Registration number" required="">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Number of Seats</label>
                        <input type="number" name="capacity" min="4" class="form-control" placeholder="Capacity" required="">
                      </div>
                    </div>
                  </div>
                 
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Vehicle Type</label>
                        <select class="form-control" name="type" required="">
                          <option>Vechicle Type</option>
                          <option value="saloon">Saloon</option>
                          <option value="bus">Min Bus</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Vehicle Model</label>
                        <input type="text" name="model" class="form-control" placeholder="model" required="">

                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Vehicle color</label>
                        <input type="text" name="color" class="form-control" placeholder="color" required="">

                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name="addcar" class="btn btn-success "><i class="fa fa-plus"></i> Submit</button>
                      <button type="reset"  class="btn btn-info "><i class="fa fa-reflesh"></i> Cancel</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>





        </div>
      </div>
     <?php include('footer.html'); ?>
</body>

</html>
