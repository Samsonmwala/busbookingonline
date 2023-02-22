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
        <?php 
                  if(isset($_SESSION['user_error'])){
                    echo $_SESSION['user_error'];
                    unset($_SESSION['user_error']);

                  }
                  ?>
          <div class="col-lg-12">
            <div class="card ">
              <div class="card-header ">
               Users
                <hr>
              </div>

              <div class="card-body">
                <div class="">
                  <table class="table table-striped table-hover">
                    <thead class=" text-primary">
                      <th>Firstname</th>
                      <th>Lastname</th>
                      <th>Email Address</th>
                      <th>Phone Number</th>
                      <th>Role</th>
                      <th>Programe</th>
                      <th>Location</th>
                      <th><i class="nc-icon nc-settings-gear-65"> </i> Action </th>
                    </thead>
                    <tbody>
                      <?php  
                      $sql1="select * from users ";
                      $runsql1=$conn->query($sql1);
                      if($row=$runsql1->num_rows > 0){
                        while($details=$runsql1->fetch_assoc()){
                          $id=$details['id'];

                        echo '
                      <tr>
                        <td>'.$details['fname'].'</td>
                        <td>'.$details['lname'].'</td>
                        <td>'.$details['email'].'</td>
                        <td>'.$details['phone'].'</td>
                        <td>'.$details['type'].'</td>
                        <td>'.$details['programe'].'</td>
                        <td>'.$details['location'].'</td>
                        <td>
                      
                        <a href="adduser.php?deluser='.$id.'"><button class="btn btn-link"><i class="fa fa-trash"></i></button</a>
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
