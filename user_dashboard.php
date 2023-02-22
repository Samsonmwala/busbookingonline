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
      
   <?php include('usernav.php')?>

      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-single-02 text-success"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">My Bookings</p>
                      <?php
                        $users="select * from booking where userid='$userid'";
                        $runuser=$conn->query($users);
                        $rowuser=$runuser->num_rows;
                       ?>
                      <p class="card-title"><?php echo $rowuser; ?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <a href="mybookings.php" ><i class="fa fa-eye"></i>List bokkings  </a>
                </div>
              </div>
            </div>
          </div>
        
          
          
        </div>
      
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">
                <h5 class="card-title">Today Routes</h5>
                <hr>
              </div>
              <div class="card-body">
                 <?php 
if(isset($_SESSION['bookok'])){
echo $_SESSION['bookok'];
unset($_SESSION['bookok']);
}

?>
                <div class="table-responsive">
                  <table class="table table-hover" style="font-size: 12px;">
                    <thead class=" text-primary">
                      <th>
                        Vehicle
                      </th>
                      <th>
                        Available Seats
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
                        Book
                      </th>
                    </thead>
                    <tbody>
              <?php 
                $route="select * from route";
                $runr=$conn->query($route);
                if($row=$runr->num_rows > 0){
                  while($routedetails=$runr->fetch_assoc()){
                  $id=$routedetails['id'];
                  $vehicle_reg=$routedetails['vehicle_reg'];
                  ////////////////////////////////////
                  $vehicle="select * from vehicle where vehicle_id='$vehicle_reg'";
                  $runv=$conn->query($vehicle);
                  $vdetails=$runv->fetch_assoc();
                 

                 echo'
                      <tr>
                        <td>'.strtoupper($vehicle_reg).'</td>
                        <td>'.$vdetails['available_seats'].'</td>
                        <td>'.$routedetails['departplace'].'</td>
                        <td>'.$routedetails['destination'].'</td>
                        <td>'.$routedetails['departime'].'</td>
                        <td>'.$routedetails['fee'].'</td>
                        <td><form method="post" action="bookings.php">
                        <input type="hidden" name="vehicleid" value='.$vehicle_reg.'>
                        <input type="hidden" name="userid" value='.$userid.'>
                        <input type="hidden" name="routeid" value='.$id.'>
                        <button type="submit" name="book" class="btn btn-link">book</button></form></td>
                      </tr>



                    ';

                  }

                }else{

                  echo '<div class="alert alert-danger">no routes to destinations available</div>';
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
