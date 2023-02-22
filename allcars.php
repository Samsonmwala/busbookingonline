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
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">
                <h4 class="card-title">My Fleet</h4>
              </div>

              <div class="card-body">
                <?php 
                  if(isset($_SESSION['loginerror'])){
                    echo $_SESSION['loginerror'];
                    unset($_SESSION['loginerror']);

                  }
                  ?>
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th><i class="nc-icon nc-badge"> </i> Registration</th>
                      <th><i class="nc-icon nc-bus-front-12"> </i> Vehicle Type</th>
                      <th><i class="nc-icon nc-bullet-list-67"> </i> Capacity</th>
                      <th><i class="nc-icon nc-delivery-fast"> </i> Model</th>
                      <th><i class="nc-icon nc-chart-pie-36"> </i> Color</th>
                      <th><i class="nc-icon nc-calendar-60"> </i> Status</th>
                      <th> <i class="nc-icon nc-settings-gear-65"> </i> Action </th>
                    </thead>
                    <tbody>
                      <?php  
                      $sql1="select * from vehicle ";
                      $runsql1=$conn->query($sql1);
                      if($row=$runsql1->num_rows > 0){
                        while($details=$runsql1->fetch_assoc()){
                            $vid=$details['vehicle_id'];
                        echo '

                      <tr>
                        <td>'.$details['vehicle_id'].'</td>
                        <td>'.$details['type'].'</td>
                        <td>'.$details['seats'].'</td>
                        <td>'.$details['model'].'</td>
                        <td>'.$details['color'].'</td>
                        <td>'.$details['status'].'</td>
               <td>
              <a href="functions.php?vid='.$vid.'"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button</a></td>
                      </tr>
                        ';
                        }

                      }else{
                        echo '<div class="alert alert-success">no vehicle</div>';                      }
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
