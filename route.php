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
      <!-- <div class="panel-header panel-header-sm">


</div> -->
      <div class="content">
        <div class="row">
        <div class="col-md-8">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title">New Route Details</h5>
              </div>

              <hr>
              <div class="card-body">

                 <?php 
                  if(isset($_SESSION['loginerror'])){
                    echo $_SESSION['loginerror'];
                    unset($_SESSION['loginerror']);

                  }
                  ?>

                <form method="post" role="form" action="functions.php">
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        
                        <select class="form-control" name="vreg" required="">
                          <option>Select vehicle</option>
                              <?php 
                                $vr="select * from vehicle where status='available'";
                                $runvr=$conn->query($vr);
                                while ($vehicle=$runvr->fetch_assoc()) {
                                  echo'
<option value="'.$vehicle['vehicle_id'].'">'.strtoupper($vehicle['vehicle_id']).' '.strtoupper($vehicle['model']).'/'.strtoupper($vehicle['type']).' </option>

                                     ';
                                }
                              ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <input type="text" name="dtime"  class="form-control" placeholder="Departure time" required="">
                      </div>
                    </div>
                  </div>
                 
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <select class="form-control" name="dplace" required="">
                          <option>Departure place</option>
                          <option value="library">Library</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <select class="form-control" name="destination" required="">
                          <option>Destination</option>
                          <option value="Chichiri_Blackgate ">Chichiri_Blackgate</option>
                          <option value="Chichiri_Polyalley">Chichiri_Polyalley</option>
                          <option value="Chichiri_Silve">Chichiri_Silvergate</option>
                          <option value="Chitawira_Blackgate">Chitawira_Blackgate</option>
                          <option value="Chitawira_GreenStone">Chitawira_GreenStone</option>
                          <option value="Chitawira_ATC">Chitawira_ATC</option>
                          <option value="Chitawira_UDF">Chitawira_UDF</option>
                          <option value="Chitawira_Ntonya_Hostels">Chitawira_Ntonya_Hostels</option>
                          <option value="Chinyonga_Greengate">Chinyonga_Greengate</option>
                          <option value="Mount Presant">Mount Presant </option>
                          <option value="Sports Council">Sports Council</option>
                          <option value="Sports Council">BetCure</option>
                          <option value="Sports Council">Naperi</option>
                          <option value="Sports Council">Kamba</option>


                        </select>
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <input type="text" name="fee" class="form-control" placeholder="fair" required="">

                      </div>
                    </div>
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <input type="text" name="remarks" class="form-control" placeholder="remarks" required="">

                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                    <button type="submit" name="addroute" class="btn btn-success "><i class="fa fa-plus"></i> Submit</button>
                      <button type="reset"  class="btn btn-info "><i class="fa fa-reflesh"></i> Cancel</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="card ">
              <div class="card-header ">
                Routes
                <hr>
              </div>

              <div class="card-body">
                <div class="">
                  <table class="table table-striped ">
                    <thead class=" text-primary">
                      <th>Departure</th>
                      <th>Destination</th>
                      <th>Time</th>
                      <th>Fee (MK)</th>
                      <th>Vehicle</th>
                      <th><i class="nc-icon nc-settings-gear-65"> </i> Action </th>
                    </thead>
                    <tbody>
                      <?php  
                      $sql1="select * from route ";
                      $runsql1=$conn->query($sql1);
                      if($row=$runsql1->num_rows > 0){
                        while($details=$runsql1->fetch_assoc()){
                          $id=$details['id'];

                        echo '
                      <tr>
                        <td>'.$details['departplace'].'</td>
                        <td>'.$details['destination'].'</td>
                        <td>'.$details['departime'].'</td>
                        <td>'.number_format((float)$details['fee'], 2, '.', '').'</td>
                        <td>'.strtoupper($details['vehicle_reg']).'</td>
                        <td>
                        <a href="edit-route.php?routeid='.$id.'"><button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                        <a href="edit-route.php?delroute='.$id.'"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                        </td>
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
     <?php include('footer.html'); ?>
</body>

</html>
