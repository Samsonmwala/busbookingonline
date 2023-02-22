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
          <div class="col-md-10" id="printableArea">
            <div class="card ">
              <div class="card-header ">
                <h5 class="card-title">My payments </h5>
             
                <hr>
              </div>
                            <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover table-striped" style="font-size: 12px;">
                    <thead class=" text-primary">
                      <th>
                        Date
                      </th>
                      <th>
                        Amount
                      </th>
                      <th>
                        Payment Method
                      </th>
                      <th>
                        Transaction ref#
                      </th>
                      <th>
                        Vehicle
                      </th>
                    </thead>
                    <tbody>
              <?php 
                $booking="select * from payment where userid='$userid'";
                $runbook=$conn->query($booking);

                $sql2="select SUM(amount) as total from payment where userid='$userid'";
                $runsql2=$conn->query($sql2);
                $tamount=$runsql2->fetch_assoc();
                if($row=$runbook->num_rows > 0){
                  while($bookingdetails=$runbook->fetch_assoc()){
                  $id=$bookingdetails['bookid'];
                  

                  $getv="select * from booking where id='$id' ";
                  $runid=$conn->query($getv);
                  $vdetails=$runid->fetch_assoc();
                  ////////////////////////////////////
                
                 

                 echo'
                      <tr>
                        <td>'.strtoupper($bookingdetails['date']).'</td>
                        <td>'.$bookingdetails['amount'].'</td>
                        <td>'.strtoupper($bookingdetails['method']).'</td>
                        <td>'.strtoupper($bookingdetails['transaction_id']).'</td>
                        <td>'.strtoupper($vdetails['vehicle_reg']).'</td>
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
                <thead>
                  <td><strong>Transactions:  <?php echo $row;?> </strong>|</td>
                  <td><strong>Total amount(MK):  <?php echo $tamount['total'];?></strong></td>
                </thead>
                <hr>
                <div class="update ml-auto mr-auto">
                      <button type="submit" name="" onclick="printDiv('printableArea')" class="btn btn-primary "><i class="fa fa-print"></i> Print</button>
                    </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      

      <?php include('footer.html');?>
  
</body>

</html>
