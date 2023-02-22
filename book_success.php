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
    

<?php include('sidebaruser.html')?>



    <div class="main-panel">
      <!-- Navbar -->
      
  <?php include('usernav.php')?>

      <!-- End Navbar -->
      <div class="content">
      <div class="row">
          
          <div class="col-md-8">
            <div class="card card-user" id="printableArea">
              <div class="card-header">
                <h5 class="card-title">Booking Receipt</h5>
              </div>
              <hr>
              <div class="card-body">
                <?php 
                if(isset($_GET['id'])){
                    $id=$_GET['id'];
                    $sql="select * from booking where id='$id'";
                    $run=$conn->query($sql);
                    $details=$run->fetch_assoc();
                    $date=$details['date'];
                    //route
                    $routeid=$details['routeid'];

                    $sqlroute="select * from route where id ='$routeid'";
                    $runroute=$conn->query($sqlroute);
                    $rdetails=$runroute->fetch_assoc();

                    ///paymet
                    $pay="select * from payment where bookid='$id'";
                    $runpay=$conn->query($pay);
                    $padetails=$runpay->fetch_assoc();
                    $userid=$padetails['userid'];

                    $user="select * from users where id = '$userid'";
                    $runuser=$conn->query($user);
                    $userdetails=$runuser->fetch_assoc();






            }

                 ?>
                <form method="post" action="">
                 

                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Vehicle Reg#</label>
                        <input type="text"  class="form-control" readonly=""  value='<?php echo  strtoupper($details['vehicle_reg']) ;?>'>
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Departure</label>
                        <input type="text" name="departure" class="form-control" readonly=""  value='<?php echo  strtoupper($rdetails['departplace']) ;?>'>
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Destination</label>
                        <input type="text" name="destination" class="form-control" readonly="" value='<?php echo  strtoupper($rdetails['destination']) ;?>'>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Payment</label>
                        <input type="text" name="deptime" class="form-control" readonly="" value='<?php echo  strtoupper($padetails['amount']) ;?>'>
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Through</label>
                        <input type="text" name="fee" class="form-control" readonly="" value='<?php echo  strtoupper($padetails['method']) ;?>'>
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Phone number</label>
                        <input type="text" name="fee" class="form-control" readonly="" value='<?php echo  strtoupper($userdetails['phone']) ;?>'>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" readonly=""  value='<?php echo  strtoupper($userdetails['fname'].' '.$userdetails['lname']) ;?>'>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Booking date</label>
                        <input type="text" class="form-control" readonly=""  value='<?php echo  strtoupper($date) ;?>'>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Transaction ID</label>
                        <input type="text" class="form-control" readonly=""  value='<?php echo  strtoupper($padetails['transaction_id']) ;?>'>
                      </div>
                    </div>
                  </div>
                  
                  <hr>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name="" onclick="printDiv('printableArea')" class="btn btn-primary "><i class="fa fa-print"></i> Print</button>
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
