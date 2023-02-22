
<?php 
session_start();
include('conn.php');

?>

<!DOCTYPE html>
<html lang="en">

<?php include('header.php');

?>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="#" class="simple-text logo-normal">
         Online Bus Booking
    
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="active">
            <a href="index.php">
              <i class="nc-icon nc-bank"></i>
              <p>Login</p>
            </a>
          </li>
          
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">User Registration</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-settings-gear-65"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Availble routes</a>
                  <a class="dropdown-item" href="#">Buses</a>
                  <a class="dropdown-item" href="#">Send message</a>
                </div>
              </li>
              
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <!-- <div class="panel-header panel-header-sm">


</div> -->
      <div class="content">
        <div class="row">
          <div class="col-md-2">
            
            
          </div>
          <div class="col-md-8">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title">User Details</h5>
              </div>
              <?php 
                if(isset($_SESSION['signuperror'])){
                    echo $_SESSION['signuperror'];
                    unset($_SESSION['signuperror']);

                }
              ;?>
              <div class="card-body">
                <form method="post" action="functions.php">
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname" class="form-control" placeholder="Firstname" required="">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Last Name</label>
                        <input type="text"  name="lname" class="form-control" placeholder="Last Name" required="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Email address</label>
                        <input type="Email" name="email" class="form-control" placeholder="Email address" required="">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Programe</label>
                        <input type="text"  name="programe" class="form-control" placeholder="Programe of Study" required="">
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
                    <div class="col-sm-2 px-1">
                      <div class="form-group">
                        <label>Country code</label>
                        <input type="text" name="ccode" class="form-control" placeholder="Country" readonly="" value="+265">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Phone number</label>
                        <input type="int"  name="phone" class="form-control" placeholder="eg-881087141" required="">
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
                      <button type="submit" name="signupuser" class="btn btn-success ">Sign up</button>
                      <button type="reset" class="btn btn-primary ">Cancel</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include('footer.html') ; ?>
</body>

</html>
