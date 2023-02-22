
<?php
session_start();
    include('header.php');
?>
<!DOCTYPE html>
<html lang="en">

<body class="" >
  <div class="wrapper">
    
     <div class="content">

      <div class="row"> 
        <div class="col-md-4">
          
        </div>


        <div class="col-md-4" style="border-radius: 0px; border-color: #f5f5f0">
          <div class="card">
            
          </div>
          <div class="card">
            
          </div>
          <div class="card">
            
          </div>
          <div class="card">
            
          </div>
        <div class="card" style="background-color: #f5f5f0">
            <div class="card-header">
               <center> <h4 class="card-title" >User Login</h4></center>
            </div>
          </div>
            <div class="card ">
              <div class="card-body">
                <center>
                  <?php 
                  if(isset($_SESSION['loginerror'])){
                    echo $_SESSION['loginerror'];
                    unset($_SESSION['loginerror']);

                  }
                  ?>
                <form role="form-control" method="post" action="functions.php">
                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label></label>
                        <input type="text" name="username" class="form-control" placeholder="Enter Username"  required="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                   <div class="col-md-12">
                      <div class="form-group">
                        <label for="exampleInputEmail1"></label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password">
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-success btn-md" name="login"><i class="nc-icon nc-button-power"></i> Login</button>
                  <input type="reset" class="btn btn-info" name="" value="Cancel">
                </form>
                <a href="signup.php"> <button class="btn btn-link btn-md" name="singnup"><i class="nc-icon nc-minimal-right"></i> Sign Up</button></a>
                </center>
                </div>
                
              </div>
            
            </div>
            
          </div>

      </div>
     
    </div>
     
      
    </div>
  
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
</body>

</html>
