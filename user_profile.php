<?php 
include('conn.php');
include('functions.php');

if(isset($_SESSION['user'])){
 $userid=$_SESSION['user'];

 $sql="select * from users where id='$userid'";
 $run=$conn->query($sql);
 $details=$run->fetch_assoc();

}



?>
<!DOCTYPE html>
<html lang="en">

<?php
  include('header.php');
  
 ?>

<body class="">
  <div class="wrapper ">
    

<?php include('sidebaruser.html')?>



    <div class="main-panel">
      <!-- Navbar -->
      
   <?php include('usernav.php')?>

      <!-- End Navbar -->
      <div class="content">
       
 
        <div class="row">
          <div class="col-md-10">
            <div class="card ">
              <div class="card-header ">
                <h5 class="card-title">User Profile</h5>
          
                <hr>
              </div>
              <?php 
if(isset($_SESSION['signuperror'])){
echo $_SESSION['signuperror'];
unset($_SESSION['signuperror']);
}

?>
          <div class="card-body">
              <form method="post" action="functions.php">
                <input type="hidden" name="userid" value='<?php echo $userid ;?>'>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>First Name</label>
      <input type="text" name="fname" class="form-control" value='<?php echo strtoupper($details['fname']); ?>' readonly="">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Last Name</label>
      <input type="text"  name="lname" class="form-control" value='<?php echo strtoupper($details['lname']); ?>' readonly="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Email address</label>
                        <input type="Email" name="email" class="form-control" value='<?php echo $details['email']; ?>'  required="">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Programe</label>
                        <input type="text"  name="programe" class="form-control" value='<?php echo $details['programe']; ?>' required="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Location</label>
                        <select class="form-control" name="location" required="">
                        <option>Select location</option>
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
                    
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Phone number</label>
                        <input type="int"  name="phone" class="form-control" value='<?php echo strtoupper($details['phone']); ?>'  required="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Password</label>
                      <input type="Password"  name="pass1" class="form-control" placeholder="Password" required="">
                      </div>
                    </div>
                    
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Repeat Password</label>
                        <input type="Password"  name="pass2" class="form-control" placeholder="repeat password" required="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" name="updateuser" class="btn btn-success ">Submit</button>
                      <button type="reset" class="btn btn-primary ">Cancel</button>
                    </div>
                  </div>
                </form> 
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
