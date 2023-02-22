<?php 

include('conn.php');
include('functions.php');

if(isset($_GET['userid'])){
$user=$_GET['userid'];
$sqlmail="select * from users where id='$user'";
$run=$conn->query($sqlmail);
$userdetails=$run->fetch_assoc();

$email=$userdetails['email'];

$update="update login set status='approved' where userid='$user'";
if($run=$conn->query($update)==TRUE){

    $to_email = $email;
      $subject = "Account Appoval for online bus booking";
$body = "Hi, Your Account has been approved";
$headers = "From: Admin";
 
if (mail($to_email, $subject, $body, $headers)) {
    
    $_SESSION['loginerror']='<div class="alert alert-succcess"><center>Approved successfuly</center></div>';
    //header('Location:registrations.php');
} else {
    echo "Email sending failed...";
}

}else{

  $_SESSION['loginerror']='<div class="alert alert-danger"><center>Approval failed</center></div>';
  header('Location:registrations.php');
}


}else if(isset($_GET['userid2'])){
$user=$_GET['userid2'];
$sqlmail="select * from users where id='$user'";
$run=$conn->query($sqlmail);
$userdetails=$run->fetch_assoc();

$email=$userdetails['email'];

$update="update login set status='approved' where userid='$user'";
if($run=$conn->query($update)==TRUE){

    $to_email = $email;
      $subject = "Account Appoval for online bus booking";
$body = "Hi, Your Account has been denied";
$headers = "From: Admin";
 
if (mail($to_email, $subject, $body, $headers)) {
    
    $_SESSION['loginerror']='<div class="alert alert-succcess"><center>Approved successfuly</center></div>';
    //header('Location:registrations.php');
} else {
    echo "Email sending failed...";
}

}else{

  $_SESSION['loginerror']='<div class="alert alert-danger"><center>Approval failed</center></div>';
  header('Location:registrations.php');
}
  
}

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
                <h4 class="card-title">Pending regisrations</h4>
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
                      <th><i class="nc-icon nc-circle-10"> </i> Name</th>
                      <th><i class="nc-icon nc-mobile"> </i> Phone</th>
                      <th><i class="nc-icon nc-email-85"> </i> Email</th>
                      <th><i class="nc-icon nc-pin-3"> </i> Location</th>
                      <th><i class="nc-icon nc-hat-3"> </i> Programme</th>
                      <th><i class="nc-icon nc-calendar-60"> </i> Date</th>
                      <th> <i class="nc-icon nc-settings-gear-65"> </i> Action </th>
                    </thead>
                    <tbody>
                      <?php  
                      $sql1="select * from login where status='pending'";
                      $runsql1=$conn->query($sql1);
                      if($row=$runsql1->num_rows > 0){
                        while($details=$runsql1->fetch_assoc()){
                            $userid= $details['userid'];
                        $sqluser="select * from users where id='$userid'";
                        $runuser=$conn->query($sqluser);
                        $userdetails=$runuser->fetch_assoc();

                        echo '

                      <tr>
                        <td>'.$userdetails['fname'].' '.$userdetails['lname'].'</td>
                        <td>'.$userdetails['phone'].'</td>
                        <td>'.$userdetails['email'].'</td>
                        <td>'.$userdetails['location'].'</td>
                        <td>'.$userdetails['programe'].'</td>
                        <td>'.$userdetails['regdate'].'</td>
                <td><a href="registrations.php?userid='.$userid.'" ><button class="btn btn-link" >Yes</button</a></td>
              <td><a href="registrations.php?userid2='.$userid.'"><button class="btn btn-link">No</button</a></td>
                      </tr>
                        ';
                        }

                      }else{
                        echo '<div class="alert alert-danger"><center>No available pending requests</center></div>';
                      }
                      ?>

                      
                <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h6 class="modal-title">Alert</h6>
      </div>
      <div class="modal-body">
        <form method="post" action="functions.php">
              
                <input type="hidden" name="searckey" class="form-control" placeholder="Search...">
                 

            </form>
            Are sure you want to approve this request?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </div>

  </div>
</div>      
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
