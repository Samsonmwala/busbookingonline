<?php 
include('conn.php');
include('functions.php');

?>
<!DOCTYPE html>
<html lang="en">

<?php
  include('header.php');
  
 ?>
<script type="text/javascript">
  function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}


</script>
<body class="">
  <div class="wrapper ">
    

<?php include('sidebar.php')?>



    <div class="main-panel">
      <!-- Navbar -->
      
  <?php include('nav.php');?>

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
                      <p class="card-category">Users</p>
                      <?php
                        $users="select * from users where type='user'";
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
                  <a href="users.php" ><i class="fa fa-eye"></i> view users</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-money-coins text-success"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Revenue</p>
                      <?php 
                      $date=date('d/m/Y');
                        $total="select SUM(amount) as total from payment where date='$date'";
                        $run=$conn->query($total);
                        $getTotal=$run->fetch_assoc();
                      ?>
                      <p class="card-title"> <?php echo number_format((float)$getTotal['total'], 2, '.', '') ; ?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                 <a href="payments.php"> <i class="fa fa-eye"></i> View revenue</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-button-pause text-danger"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Registrations </p>
                      <?php
                        $pending="select * from login where type='user' and status='pending'";
                        $runP=$conn->query($pending);
                        $rowP=$runP->num_rows;
                       ?>
                      <p class="card-title"><?php echo $rowP; ?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                    <a href="registrations.php"> <i class="fa fa-eye"></i> List</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-favourite-28 text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Bookings</p>
                      <p class="card-title">
                        <?php 
                      $date=date('d/m/Y');
                        $booking="select * from booking where date='$date'";
                        $runbooking=$conn->query($booking);
                        $getBooking=$runbooking->num_rows;
                        echo $getBooking;
                      ?>
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                 <a  href="" > <i class="fa fa-eye"> View</i> </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <?php 

            if(isset($_SESSION['bookok'])){
              echo $_SESSION['bookok'];
              unset($_SESSION['bookok']);

            }
           ?>
          <div class="col-md-12">

            <div class="card ">
              <div class="card-header ">
                <p class="card-category pull-right"><button class="btn btn-primary" onclick="printDiv('printableArea')" ><i class="fa fa-print"></i> Print</button> </p>
               
                
              </div>
              <div class="card-body" id="printableArea">
                 <h5 class="card-title">Today bookings</h5>
                <div >
                  <table class="table table-bordered table-hover">
                    <thead class=" text-primary">
                      <th>
                        Fullname
                      </th>
                      <th>
                        Phone number
                      </th>
                      <th>
                        Selected Route
                      </th>
                      <th>
                        Vehicle Registration
                      </th>
                      
                      <th>
                        Booking Status
                      </th>
                      <th>
                         <i class="nc-icon nc-settings-gear-65"></i>
                      </th>
                    </thead>
                    <tbody>
                      <?php 
                        $date=date('d/m/Y');
                        $get="select * from booking where date = '$date'";
                        $run=$conn->query($get);
                        if($row=$run->num_rows > 0){
                            while($details=$run->fetch_assoc()){
                              $userid=$details['userid'];
                              $route=$details['routeid'];

                              $sqlroute="select * from route where id ='$route'";
                              $runroute=$conn->query($sqlroute);
                              $routeDetails=$runroute->fetch_assoc();

                              $sqluser="select * from users where id='$userid'";
                              $runuser=$conn->query($sqluser);
                              $userDetails=$runuser->fetch_assoc();

                              $payment="select * from payment where date='$date' and userid='$userid'";
                              $runP=$conn->query($payment);
                              $pdetails=$runP->fetch_assoc();

                                if($details['status']=='canceled'){

                                    
                              echo '
                    <tr>
                        <td>
                          '.$userDetails['fname'].' '.$userDetails['lname'].'
                        </td>
                        <td>
                          '.$userDetails['phone'].'
                        </td>
                        <td>
                        '.$routeDetails['departplace'].'-'.$routeDetails['destination'].'
                        </td>
                        <td>
                          '.strtoupper($routeDetails['vehicle_reg']).'
                        </td>
                        <td>
                          '.$details['status'].'
                        </td>
                        <td><a href="book.php?cancelid='.$details['id'].'">remove</a></td>
                        
                    </tr>

                               ';
                                }else{

                              echo '
                    <tr>
                        <td>
                          '.$userDetails['fname'].' '.$userDetails['lname'].'
                        </td>
                        <td>
                          '.$userDetails['phone'].'
                        </td>
                        <td>
                        '.$routeDetails['departplace'].'-'.$routeDetails['destination'].'
                        </td>
                        <td>
                          '.strtoupper($routeDetails['vehicle_reg']).'
                        </td>
                        <td>
                          '.$details['status'].'
                        </td>
                        <td>
                          
                        </td>
                        
                    </tr>

                               ';
                                }

                            }

                        }else{

                          echo '<div class="alert alert-danger"><center>No bookings currently</centert></div>';
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
