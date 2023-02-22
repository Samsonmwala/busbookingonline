<?php
session_start();
include('conn.php');

if(isset($_POST['book'])){
$userid=$_POST['userid'];	
$vehicleid=$_POST['vehicleid'];
$phone=$_POST['phone'];
$route=$_POST['route'];
$email=$_POST['email'];
$date=date('d/m/Y');
$fee=$_POST['fee'];
$method=$_POST['payment'];
$transaction_id=$_POST['transactionid'];

	////check user
	$sqlche="select * from booking where userid='$userid' and routeid='$route'";
	$runcheck=$conn->query($sqlche);

	$sqltr="select * from payment where transaction_id='$transaction_id'";
	$runtr=$conn->query($sqlche);


	if($row=$runcheck->num_rows > 0){
		$_SESSION['bookok']='<div class="alert alert-danger">Your are trying to book the same route, try again</div>';
		header('Location:user_dashboard.php');

	}else if($row2=$runtr->num_rows > 0){
		$_SESSION['bookok']='<div class="alert alert-danger">Your are trying to pay with the same Transaction ID</div>';
		header('Location:user_dashboard.php');
	}else{
			$sqlup="select * from vehicle where vehicle_id='$vehicleid'";
			$run=$conn->query($sqlup);
  while($vdetails=$run->fetch_assoc()){
    $capacity=$vdetails['seats'];
    $available_seats=$vdetails['available_seats'];
    $seats=0;
    if($available_seats <= $capacity){
    $seats=$available_seats - 1;
      $update="update vehicle set available_seats='$seats' where vehicle_id='$vehicleid'";
      if($runupdate=$conn->query($update)===TRUE){
        $insert="insert into booking values('','$userid','$vehicleid','$route','$date','booked')";
        
        if($runisert=$conn->query($insert)===TRUE){

          $get="select * from booking where date='$date' order by id desc";
          $runget=$conn->query($get);
          $getid=$runget->fetch_assoc();
          $id=$getid['id'];

        //payment
      $payment="insert into payment values('','$id','$date','$fee','$userid','$method','$transaction_id','pending')";
          $runpay=$conn->query($payment);

           $to = $email;
            $subject = 'Mail from NBBMS';
            $message = 'Dear Client. Please be reminded that you have booked with us.';
            $headers = "From: samsonmwala@gmail.com";
            mail($to, $subject, $message, $headers); 
          $_SESSION['bookok']='<div class="alert alert-success">Booking was successful</div>';
          header('Location:book_success.php?id='.$id.'');


        }else{


        }

        
        

      }else{

        echo 'failed to update';
      }

    }else if($available_seats==0){
     $update="update vehicle set status='booked' where vehicle_id='$vehicleid'";
      
      $ru2=$conn->query($update);
      $_SESSION['bookok']='<div class="alert alert-danger">Booking failed. Vehicle full</div>';
      header('Location:user_dashboard.php');
    }




  }

	}
}else if(isset($_GET['bookid'])){

$id=$_GET['bookid'];

$sql="select * from booking where id='$id'";
$run1=$conn->query($sql);
$details=$run1->fetch_assoc();

$vehicle=$details['vehicle_reg'];

$sql1="update booking set status='canceled' where id='$id'";
if($run=$conn->query($sql1)===TRUE){
///retaining seats

  $car="select * from vehicle where vehicle_id='$vehicle'";
  $runcar=$conn->query($car);
  $cdetails=$runcar->fetch_assoc();

 $available_seats=$cdetails['available_seats'];

  $new=$available_seats + 1;

  $seat="update vehicle set available_seats='$new' where vehicle_id='$vehicle'";
  $runseat=$conn->query($seat);

	     $_SESSION['bookok']='<div class="alert alert-success">Booking Canceled</div>';
      header('Location:mybookings.php');

}else{

	$_SESSION['bookok']='<div class="alert alert-danger">Booking Cancil Failed</div>';
  header('Location:mybookings.php');
	
}


}else if(isset($_GET['approvep'])){
$bookid=$_GET['approvep'];


  $user="select * from payment where bookid='$bookid'";
  $runuser=$conn->query($user);
  $details=$runuser->fetch_assoc();

  $userid=$details['userid'];

$sql="update payment set status='approved' where bookid='$bookid'";
  if($runsql=$conn->query($sql)===TRUE){

    $sql2="update booking set status='approved' where id='$bookid'";
    $runsql2=$conn->query($sql2);
    $date=date('d/m/Y');
    $insert="insert into notifications values('','$userid','your booking was approved','new','$date')";
    $runinsert=$conn->query($insert);

      $_SESSION['bookok']='<div class="alert alert-success">Payment and Booking Approved</div>';
      header('Location:payments.php');


  }else{
     $_SESSION['bookok']='<div class="alert alert-danger">Payment and Booking Approval failed</div>';
      header('Location:payments.php');

  }




}else if(isset($_GET['see'])){
  $notid=$_GET['see'];
  $update="update notifications set status='read' where id='$notid'";
  if($run=$conn->query($update)===TRUE){
    header('Location:user_dashboard.php');


  }else{

    echo 'error';
  }


}else if(isset($_GET['cancelid'])){

  $id=$_GET['cancelid'];
  $get="select * from booking where id='$id'";
  $rung=$conn->query($get);
  $details=$rung->fetch_assoc();

  $userid=$details['userid'];
  $sqluser="select * from users where id='$userid'";
  $runsqluser=$conn->query($sqluser);
  $udetails=$runsqluser->fetch_assoc();

  $email=$udetails['email'];

  $date=date('d/m/Y');
  $delete="delete from booking where id='$id'";
  $run=$conn->query($delete);

  $deletep="delete from payment where bookid='$id'";
  $runp=$conn->query($deletep);

  $insert="insert notifications values('','$userid','payment has been retained for the booking canceled','new','')";
  if($runinsert=$conn->query($insert)===TRUE){

            $to = $email;
            $subject = 'Mail from NBBMS';
            $message = 'Dear Client. your booking Has been cancelled succefully please wait for refund or contact admin @ 
            +265884851069 ';
            $headers = "From: samsonmwala@gmail.com";
            mail($to, $subject, $message, $headers); 
    $_SESSION['bookok']='<div class="alert alert-success">Payment and Booking retained</div>';
    header('Location:dashboard.php');

  }else{

     $_SESSION['bookok']='<div class="alert alert-success">Payment and Booking retained failed</div>';
  
    header('Location:dashboard.php');

  }


}





 ?>