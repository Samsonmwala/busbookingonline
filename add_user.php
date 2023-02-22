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
                <h5 class="card-title">User Details</h5>
              </div>

              <hr>
              <div class="card-body">

                 <?php 
                  if(isset($_SESSION['user_error'])){
                    echo $_SESSION['user_error'];
                    unset($_SESSION['user_error']);

                  }
                  ?>

                <form method="post" role="form" action="adduser.php">
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Firstname</label>
                        <input type="text" name="fname" class="form-control" placeholder="Firstname" required="">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Lastname</label>
                        <input type="text" name="lname"  class="form-control" placeholder="Lastname" required="">
                      </div>
                    </div>
                  </div>
                 
                  <div class="row">
                    
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Email address</label>
                      <input type="email" name="email" class="form-control" placeholder="Email Address" required="">

                      </div>
                    </div>
                   
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Phone number</label>
                        <input type="text"  name="phone" class="form-control" placeholder="eg-881087141" required="">
                      </div>
                    </div>
                    
                  </div>
                   <div class="row">
                    
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Password</label>
                      <input type="Password" name="pass1" class="form-control" placeholder="Password" required="">

                      </div>
                    </div>
                    
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Repeat Password</label>
                        <input type="Password"  name="pass2" class="form-control" placeholder="Repeat Password" required="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name="adduser" class="btn btn-success "><i class="fa fa-plus"></i> Submit</button>
                      <button type="reset"  class="btn btn-info "><i class="fa fa-reflesh"></i> Cancel</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h6 class="modal-title">Vehicle Lookup</h6>
      </div>
      <div class="modal-body">
        <form method="post" action="functions.php">
              <div class="input-group no-border">
                <input type="text" name="searckey" class="form-control" placeholder="Search...">
                 <button type="button" class="btn btn-info" ><i class="nc-icon nc-zoom-split"></i></button>
              </div>

            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



        </div>
      </div>
     <?php include('footer.html'); ?>
</body>

</html>
