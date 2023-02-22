    <div class="sidebar" data-color="white" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="" class="simple-text logo-mini">
          <div class="logo-image-small">
          </div>
        </a>
        <a href="" class="simple-text logo-normal">
         <?php 
         if(isset($_SESSION['user'])){
            $userid=$_SESSION['user'];
            $sql="select * from users where id ='$userid'";
            $run=$conn->query($sql);
            $details=$run->fetch_assoc();
            echo $details['fname'].' '.$details['lname'];

           }

        ?>
         
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="active ">
            <a href="dashboard.php">
              <i class="nc-icon nc-layout-11"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li>
            <a href="cars.php">
              <i class="nc-icon nc-spaceship"></i>
              <p>Cars</p>
            </a>
          </li>
          <li>
            <a href="route.php">
              <i class="nc-icon nc-pin-3"></i>
              <p>Routes</p>
            </a>
          </li>
          <li>
            <a href="payments.php">
              <i class="nc-icon nc-bank"></i>
              <p>Payments</p>
            </a>
          </li>
          <li>
            <a href="update_profile.php">
              <i class="nc-icon nc-single-02"></i>
              <p>User Profile</p>
            </a>
          </li>
          
        </ul>
      </div>
    </div>