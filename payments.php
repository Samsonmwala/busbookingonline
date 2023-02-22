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
  <?php include('nav.php')?>

      <!-- End Navbar -->
      <div class="content">

        <div class="row">
    <div class="col-md-11">
            <div class="card ">
              <div class="card-header ">
                
                  <form method="post" role="form" action="payments.php">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                     
                        <input type="text" name="sky" class="form-control" placeholder="Transaction id" required="">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
            
                       <button type="submit" name="searchp" class="btn btn-success ">Search</button>
                      </div>
                    </div>
                  </div>
                  </form>
              </div>
              <div class="card-body">
                <?php 
                if(isset($_POST['searchp'])){
                 $sky=strtolower($_POST['sky']);
                    $search="select * from payment where transaction_id = '$sky'";
                    $run=$conn->query($search);
                    if($row=$run->num_rows > 0){
                      $pdetails=$run->fetch_assoc();
                      $userid=$pdetails['userid'];
                        $amout=$pdetails['amount'];
                        $method=$pdetails['method'];
                        $txid=$pdetails['transaction_id'];
                        $date=$pdetails['date'];

                      $sqluser="select * from users where id='$userid'";
                      $runuser=$conn->query($sqluser);
                      $userdetails=$runuser->fetch_assoc();

                      echo '
                        <table class="table table-hover table-bordered">
                            <thead class=" text-primary">
                               <th>Date</th>
                               <th>Amount</th>
                               <th>From</th>
                               <th>Method</th>
                               <th>TransactionID </th
                            <th>Status</th>
                               
                            </thead>
                            <tbody>
                            <tr>
                                     <td>'.$pdetails['date'].'</td>
                                      <td>'.number_format((float)$pdetails['amount'], 2, '.', '').'</td>
                                      <td>'.$userdetails['fname'].' '.$userdetails['lname'].'</td>
                                      <td>'.$pdetails['method'].'</td>
                                      <td>'.$pdetails['transaction_id'].'</td>
                                      <td>'.$pdetails['status'].'</td>
                                   

                                 </tr>
                                 </tbody>

                                </table>

                        ';
                    }else{

                      echo '<div class="alert alert-warning">No record found</div>';
                    }

                }else{


                }

                ?>
              </div>

        
              
              
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="card " >
              <div class="card-header "><p class="card-category"><button class="btn btn-primary" onclick="printDiv('printableArea')" ><i class="fa fa-print"></i> Print</button> <a href="all_payment.php"> <button class="btn btn-primary"  ><i class="fa fa-list"></i> All Payment</button> </a> </p>
                <h5 class="card-title">Total Payments For today</h5>
                <?php 
                  if(isset($_SESSION['bookok'])){
                    echo $_SESSION['bookok'];
                    unset($_SESSION['bookok']);


                  }

                ?>
              </div>
              <div class="card-body " id="printableArea">
                <div >
                  <table class="table table-hover table-bordered">
                    <thead class=" text-primary">
                      <th>
                        Date
                      </th>
                      <th>
                        Amount
                      </th>
                      <th>
                        From
                      </th>
                      <th>
                        Method
                      </th>
                      <th>TransactionID </th>
                      <th>Status </th>
                         <th><i class="nc-icon nc-settings-gear-65"></i></th>
                      
                    </thead>
                    <tbody>
                      <?php
                            $date=date('d/m/Y');
                        
                        $revenue="select * from payment where date='$date'";
                        $runrev=$conn->query($revenue);
                        if($row=$runrev->num_rows > 0){
                          while($details=$runrev->fetch_assoc()){
                            $userid=$details['userid'];

                            $sqluser="select * from users where id='$userid'";
                            $runuser=$conn->query($sqluser);
                            $userdetails=$runuser->fetch_assoc();

                            echo '<tr>
                                      <td>'.$details['date'].'</td>
                                      <td>'.number_format((float)$details['amount'], 2, '.', '').'</td>
                                      <td>'.$userdetails['fname'].' '.$userdetails['lname'].'</td>
                                      <td>'.$details['method'].'</td>
                                      <td>'.$details['transaction_id'].'</td>
                                      <td>'.$details['status'].'</td>
                                      <td><a href="book.php?approvep='.$details['bookid'].'">approve</a></td>

                                 </tr>';

                          }
                        }else{

                          echo '<div class="alert alert-danger"><center>No payments currently</centert></div>';
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
        <div class="row">
          
         
        </div>
      </div>
      

      <?php include('footer.html');?>
  
</body>

</html>
