
<?php 
include('conn.php');
include('functions.php');


	if(isset($_GET['routeid'])){
		$routeid=$_GET['routeid'];
		$sql="select * from route where id = '$routeid'";
		$run=$conn->query($sql);
		$routedetails=$run->fetch_assoc();

	}else if(isset($_GET['delroute'])){
    $routeid=$_GET['delroute'];
      $delete="delete from route where id='$routeid'";
      $rundel=$conn->query($delete);

      $_SESSION['loginerror']='<div class="alert alert-success">Route deleted</div>';
      header('Location:route.php');

  }
?>
<!DOCTYPE html>
<html lang="en">

<?php
  include('header.php');
  
 ?>

<body class="">
  <div class="wrapper ">
    

<?php include('sidebar.php');?>



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
                <h5 class="card-title">Edit Route Details</h5>
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
                  <input type="hidden" name="routeid" value='<?php echo $routeid ;?>'>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                      	<label>Registration number</label>
           <input type="text" name="vreg"  class="form-control" value='<?php echo  $routedetails['vehicle_reg'] ;?>' required="">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                      	<label>Departure Time</label>
          <input type="text" name="dtime"  class="form-control"  value='<?php echo $routedetails['departime'] ;?>' required="">
                      </div>
                    </div>
                  </div>
                 
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Departure Place</label>
          <input type="text" name="departure"  class="form-control"  value='<?php echo $routedetails['departplace'] ;?>' required="">
                      </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                          <label>Destination</label>
                          
        <input type="text" name="destination"  class="form-control"  value='<?php echo $routedetails['destination'] ;?>' required="">             </div>
                    </div>
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                      	<label>Fair (MWK)</label>
     <input type="text" name="fee" class="form-control"  value='<?php echo number_format((float)$routedetails['fee'], 2, '.', ''); ?>' required="">

                      </div>
                    </div>
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                      	<label>Remarks</label>
                        <input type="text" name="remarks" class="form-control" value='<?php echo $routedetails['remarks']; ?>' required=""  >

                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                    <button type="submit" name="editroute" class="btn btn-success "><i class="fa fa-pencil-square-o"></i> Update</button>
                      <button type="reset"  class="btn btn-info "><i class=""></i> Cancel</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          
        </div>
      </div>
     <?php include('footer.html'); ?>
</body>

</html>
