<?php 
include('conn.php');
include('functions.php');

if(isset($_SESSION['user'])){
$userid=$_SESSION['user'];

}

if(isset($_POST['book'])){
$routeid=$_POST['routeid'];
$userid=$_POST['userid'];
$vehicleid=$_POST['vehicleid'];
$status='booked';
$date=date('d/m/Y');

//route details
$sqlroute="select * from route where id='$routeid'";
$runeoute=$conn->query($sqlroute);
$routeD=$runeoute->fetch_assoc();

//user details
$userdetails="select * from users where id='$userid'";
$runuser=$conn->query($userdetails);
$user=$runuser->fetch_assoc();



}else{

  echo 'mbola';
}






?>
<!DOCTYPE html>
<html lang="en">

<?php
  include('header.php');
  
 ?>

<body class="">
  <div class="wrapper ">
    

<?php include('sidebaruser.html')?>



    <div class="main-panel">
      <!-- Navbar -->
      
   <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo"><?php echo date('d-M Y'); ?></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="nc-icon nc-zoom-split"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link btn-magnify" href="#pablo">
                  <i class="nc-icon nc-layout-11"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Stats</span>
                  </p>
                </a>
              </li>
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-bell-55"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link btn-rotate" href="#pablo">
                  <i class="nc-icon nc-settings-gear-65"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- End Navbar -->
      <div class="content">
      <div class="row">

          <div class="col-md-8">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title">Booking details (MPAMBA: 0884851069)</h5>
              </div>
              <?php 
            if(isset($_SESSION['bookok'])){
              echo $_SESSION['bookok'];
              unset($_SESSION['bookok']);

            }

          ?>
              <hr>
              <div class="card-body">
                <form method="post" action="book.php">
                  <input type="hidden"  name="vehicleid" value='<?php echo $vehicleid ;?>'>
                  <input type="hidden"  name="route" value='<?php echo $routeid ;?>'>
                  <input type="hidden"  name="phone" value='<?php echo $user['phone'] ;?>'>
                  <input type="hidden"  name="email" value='<?php echo $user['email'] ;?>'>
                  <input type="hidden"  name="userid" value='<?php echo $userid ;?>'>
                  <input type="hidden"  name="fee" value='<?php echo $routeD['fee'] ;?>'>

                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Vehicle</label>
                        <input type="text"  class="form-control" readonly=""  value='<?php echo  strtoupper($vehicleid) ;?>'>
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Departure</label>
                        <input type="text" name="departure" class="form-control" readonly=""  value='<?php echo  strtoupper($routeD['departplace']) ;?>'>
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Destination</label>
                        <input type="text" name="destination" class="form-control" readonly="" value='<?php echo  strtoupper($routeD['destination']) ;?>'>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Departure time</label>
                        <input type="text" name="deptime" class="form-control" readonly="" value='<?php echo  strtoupper($routeD['departime']) ;?>'>
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Fee</label>
                        <input type="text" name="fee" class="form-control" readonly="" value='<?php echo  strtoupper($routeD['fee']) ;?>'>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Payment Method</label>
                       <select class="form-control" name="payment" required="">
                        <option value="tnm mpamba">Tnm Mpamba</option>
                        <option value="airtel money">Airtel Money</option>
                        <option value="cash">Cash Pay</option>
                        <option value="bank">Bank </option>
                       </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label>Payment Transation ID</label>
                    <input type="text" class="form-control" placeholder="Enter payment transction id" name="transactionid" required="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Route Description</label>
                        <input type="text" class="form-control"  value='<?php echo  strtoupper($routeD['remarks']) ;?>' readonly="">
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name="book" class="btn btn-success btn-round">Submit</button>
                    <a href="user_dashboard.php" <button type="button"  class="btn btn-primary btn-round">Back</button><a/>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      

      <?php include('footer.html');?>
  
</body>

</html>
