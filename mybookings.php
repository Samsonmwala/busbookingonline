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
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">

                <h5 class="card-title">My booking </h5>
                <hr>


              <a href="all_cus_bookings.php"><button class="btn btn-primary">All Bookings</button></a>
              <?php
                    if(isset($_SESSION['bookok'])){
                      echo $_SESSION['bookok'];
                      unset($_SESSION['bookok']);

                    }


                 ?>
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
                      <th>
                          <i class="nc-icon nc-settings-gear-65"></i>
                      </th>
                    </thead>
                    <tbody>
              <?php 
              $date=date('d/m/Y');
                $booking="select * from booking where userid='$userid' and date='$date' ";
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
                        <td><a href="book.php?bookid='.$id.'">Cancel</a></td>
                      </tr>



                    ';

                  }

                }else{

                  echo '<div class="alert alert-danger">no booking to display for to day</div>';
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
