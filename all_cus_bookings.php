<?php 
include('conn.php');
include('functions.php');

if(isset($_SESSION['user'])){
 $userid=$_SESSION['user'];

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
            
            <ul class="navbar-nav">
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
              
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-settings-gear-65"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  
                  <a class="dropdown-item" href="logout.php"><i class="nc-icon nc-button-power"></i> Logout</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <!-- End Navbar -->
      <div class="content">
       
 
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">

                <h5 class="card-title">My booking </h5>
               
                <hr>
              </div>
           
  
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover table-striped" style="font-size: 12px;">
                    <thead class=" text-primary">
                      <th>
                        Vehicle
                      </th>
                      <th>
                        Date of Book
                      </th>
                      <th>
                        Departure
                      </th>
                      <th>
                        Destination
                      </th>
                      <th>
                        Time
                      </th>
                      <th>
                        Fee
                      </th>
                      <th>
                        Model
                      </th>
                      <th>
                        Status
                      </th>
                    
                    </thead>
                    <tbody>
              <?php 
            
                $booking="select * from booking where userid='$userid'";
                $runbook=$conn->query($booking);
                if($row=$runbook->num_rows > 0){
                  while($bookingdetails=$runbook->fetch_assoc()){
                  $id=$bookingdetails['id'];
                  $routeid=$bookingdetails['routeid'];
                  $vehicle_id=$bookingdetails['vehicle_reg'];
                  ////////////////////////////////////
                  $route="select * from route where id='$routeid'";
                  $runr=$conn->query($route);
                  $rdetails=$runr->fetch_assoc();

                  $vehicle="select * from vehicle where vehicle_id='$vehicle_id'";
                  $runve=$conn->query($vehicle);
                  $vdetails=$runve->fetch_assoc();;
                 

                 echo'
                      <tr>
                        <td>'.strtoupper($bookingdetails['vehicle_reg']).'</td>
                        <td>'.$bookingdetails['date'].'</td>
                        <td>'.$rdetails['departplace'].'</td>
                        <td>'.$rdetails['destination'].'</td>
                        <td>'.$rdetails['departime'].'</td>
                        <td>'.$rdetails['fee'].'</td>
                        <td>'.$vdetails['model'].'</td>
                        <td>'.$bookingdetails['status'].'</td>
                      
                      </tr>



                    ';

                  }

                }else{

                  echo '<div class="alert alert-danger">You have no bookings</div>';
                }



              ?>
                      
                      
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class=""></i> 
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      

      <?php include('footer.html');?>
  
</body>

</html>
