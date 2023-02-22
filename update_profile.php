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
                  <input type="hidden" name="userid" value='<?php echo $userid ;?>'>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Firstname</label>
                        <input type="text" value='<?php echo $details['fname']?>' class="form-control" readonly="">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Lastname</label>
                        <input type="text" value='<?php echo $details['lname']?>'  class="form-control" readonly>
                      </div>
                    </div>
                  </div>
                 
                  <div class="row">
                    
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Email address</label>
                      <input type="email" name="email" class="form-control" value='<?php echo $details['email']?>' required="">

                      </div>
                    </div>
                   
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Phone number</label>
                        <input type="text"  name="phone" class="form-control" value='<?php echo $details['phone']?>' required="">
                      </div>
                    </div>
                    
                  </div>
                   <div class="row">
                    
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Role</label>
                      <input type="text"  class="form-control" value='<?php echo $details['type']?>' readonly="">

                      </div>
                    </div>
                    
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Password</label>
                        <input type="Password" value='<?php echo $details['type']?>'  name="pass" class="form-control"  required="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name="update_profile" class="btn btn-success "><i class="fa fa-plus"></i> Update Profile</button>
                      <button type="reset"  class="btn btn-info "><i class="fa fa-reflesh"></i> Cancel</button>
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
