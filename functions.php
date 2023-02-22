<?php
session_start();
include('conn.php');

function clean($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/////user

if(!isset($_SESSION['user'])){

header('Location:index.php');	
}

if(isset($_POST['signup'])){
header('Location:sigup.php');

}else if(isset($_POST['signupuser'])){

	$fname=clean($_POST['fname']);
	$lanem=clean($_POST['lname']);
	$email=clean($_POST['email']);
	$phone=clean($_POST['phone']);
	$location=clean($_POST['location']);
	$ccode=clean($_POST['ccode']);
	$programe=clean($_POST['programe']);
	$pass1=clean($_POST['pass1']);
	$pass2=clean($_POST['pass2']);
	$date=date('d/m/Y');


	$phonenumber=$ccode.$phone;

	if($pass2 !== $pass1){
		$_SESSION['signuperror']='<div class="alert alert-danger">Passwords do not much</div>';
		header('Location:signup.php');

	}else{
			$sqlcheck="SELECT * FROM users WHERE email='$email' OR phone='$phonenumber'";
			$run=$conn->query($sqlcheck);
			if($row=$run->num_rows > 0){
				$_SESSION['signuperror']='<div class="alert alert-danger">Email or Phone number already in use</div>';
				header('Location:signup.php');

			}else{
				//insert
				$sqlAdduser="INSERT INTO users values('','$fname','$lanem','$email','user','$location','$programe','$phonenumber','$date');";
				if($runadd=$conn->query($sqlAdduser)===TRUE){
					$passord=md5($pass2);
					$sqid="SELECT * FROM users where email='$email'  order by id desc LIMIT 1";
					$runid=$conn->query($sqid);
					$detailsid=$runid->fetch_assoc();

					$id=$detailsid['id'];


					$login="INSERT INTO login values('$id','$email','$passord','user','pending')";
					if($run=$conn->query($login)===TRUE){

							$_SESSION['signuperror']='<div class="alert alert-success">Your Request has been submited awaiting aproval</div>';
				header('Location:signup.php');
					}else{
						$_SESSION['signuperror']='<div class="alert alert-danger">Failed to add to database login</div>';
				header('Location:signup.php');
							
					}


				}else{
					$_SESSION['signuperror']='<div class="alert alert-danger">Failed to add to database</div>';
				header('Location:signup.php');

				}
			}
	}

}else if(isset($_POST['login'])){

$password=md5(clean($_POST['password']));
$username=clean($_POST['username']);
//checking
$login="SELECT * FROM login WHERE username='$username' AND password='$password'";
$runlogin=$conn->query($login);
if($row=$runlogin->num_rows > 0){
	$logindetails=$runlogin->fetch_assoc();
		if($logindetails['status']=='pending'){

			$_SESSION['loginerror']='<div class="alert alert-danger">Account not approved yet</div>';
			header('Location:index.php');
		}else if($logindetails['status']=='approved'){
			if($logindetails['type']=='admin'){
				$userid= $logindetails['userid'];
				$_SESSION['user']=$userid;
				header('Location:dashboard.php');

			}else if($logindetails['type']=='user'){
				$userid=$logindetails['userid'];
				$_SESSION['user']=$userid;
				header('Location:user_dashboard.php');

			}else{
				$_SESSION['loginerror']='<div class="alert alert-danger">User Account not found</div>';
				header('Location:index.php');
			}

		}

}else{

	$_SESSION['loginerror']='<div class="alert alert-danger">Incorrect Login Credentials</div>';
	header('Location:index.php');
}

}else if (isset($_POST['addcar'])){
	$registration=clean($_POST['vehiclereg']);
	$capacity=clean($_POST['capacity']);
	$type=clean($_POST['type']);
	$model=clean($_POST['model']);
	$color=clean($_POST['color']);
	$status='available';
	//////checking
	$sqlcheck="SELECT * FROM vehicle WHERE vehicle_id='$registration'";
	$runcheck=$conn->query($sqlcheck);
	if($row=$runcheck->num_rows > 0){
		$_SESSION['loginerror']='<div class="alert alert-danger"><center>registration number already exist</center></div>';
		header('Location:cars.php');

	}else{
		$insert="INSERT INTO vehicle values('$registration','$type','$capacity','$status','$model','$color','$capacity')";
		if($runinsert=$conn->query($insert)===TRUE){
		$_SESSION['loginerror']='<div class="alert alert-success"><center>vehile addedd successfully</center></div>';
		header('Location:cars.php');
		}else{
		$_SESSION['loginerror']='<div class="alert alert-danger"><center>Failed to add vehile, try again</center></div>';
		header('Location:cars.php');

		}
	}

}else if(isset($_POST['addroute'])){
	$vehicle=clean($_POST['vreg']);
	$dtime=clean($_POST['dtime']);
	$dplace=clean($_POST['dplace']);
	$destination=clean($_POST['destination']);
	$fee=clean($_POST['fee']);
	$remarks=clean($_POST['remarks']);

	////checking route

	//$checking="select * from route where departplace='$dplace' and destination='$destination'";
	//$runcheck=$conn->query($checking);
			if($destination==$dplace){
		$_SESSION['loginerror']='<div class="alert alert-danger"><center>You selected an impossible route, destination and departure are the same</center></div>';
		header('Location:route.php');

			}else{

				$insert="insert into route values('','$vehicle','$dtime','$dplace','$destination','$fee','$remarks')";
				if($ruinsert=$conn->query($insert)===TRUE){
		$_SESSION['loginerror']='<div class="alert alert-succcess"><center>Route was added successfuly</center></div>';
		header('Location:route.php');

				}else{
					$_SESSION['loginerror']='<div class="alert alert-danger"><center>Failed to add route, try again</center></div>';
		header('Location:route.php');
				}
			}

}else if(isset($_POST['updateuser'])){
	$userid=$_POST['userid'];
	$email=clean($_POST['email']);
	$phone=clean($_POST['phone']);
	$location=clean($_POST['location']);
	$ccode=clean($_POST['ccode']);
	$programe=clean($_POST['programe']);
	$pass1=clean($_POST['pass1']);
	$pass2=clean($_POST['pass2']);

	if($pass2!==$pass1){

		$_SESSION['signuperror']='<div class="alert alert-danger">Passwords do not much</div>';
		header('Location:user_profile.php');
	}else{

		$update="update users set email='$email', location='$location', programe='$programe', phone='$phone' where id='$userid'";
		if($runupdate=$conn->query($update)===TRUE){
			$newpass=md5($pass2);
			$updatelogin="update login set passwor='$newpass' where userid='$userid'";
			$runlogin=$conn->query($updatelogin);
			$_SESSION['signuperror']='<div class="alert alert-success">Update profile was successful</div>';
			header('Location:user_profile.php');


		}else{
			$_SESSION['signuperror']='<div class="alert alert-danger">Update error</div>';
			header('Location:user_profile.php');

		}

	}

}else if(isset($_POST['editroute'])){

echo 	$routeid=clean($_POST['routeid']);
$vreg=clean($_POST['vreg']);
$dtime=clean($_POST['dtime']);
$departure=clean($_POST['departure']);
$destination=clean($_POST['destination']);
$fee=clean($_POST['fee']);
$remarks=clean($_POST['remarks']);

////check car
		$check="select * from vehicle where vehicle_id='$vreg'";
		$runcheck=$conn->query($check);

		if($row=$runcheck->num_rows > 0){
	$update="update route set vehicle_reg='$vreg', departime='$dtime', departplace='$departure', destination='$destination', fee='$fee', remarks='$remarks' where id='$routeid'";
			if($runupdate=$conn->query($update)===TRUE){
			$_SESSION['loginerror']='<div class="alert alert-success">Update route was successful</div>';
			header('Location:edit-route.php?routeid='.$routeid);
		}else{

			echo 'Failed';
		}

		}else{

			$_SESSION['loginerror']='<div class="alert alert-danger">vehicle registration number not found</div>';
			header('Location:edit-route.php?routeid='.$routeid);
		}


}else if(isset($_GET['vid'])){
$vid=$_GET['vid'];

$check="select from booking where vehicle_reg = '$vid'";
$runcheck=$conn->query($check);
	if($row=$runcheck->num_rows >0 ){
		$_SESSION['loginerror']='<div class="alert alert-danger">Vehicle in booking cannot be removed.</div>';
		header('Location:allcars.php');

	}else{

		$delete="delete from vehicle where vehicle_id='$vid'";
		$rundel=$conn->query($delete);

		$del2="delete from booking where vehicle_reg= '$vid'";
		$rundel2=$conn->query($del2);

		$del3="delete from route where vehicle_reg= '$vid'";
		$rundel3=$conn->query($del3);

$_SESSION['loginerror']='<div class="alert alert-success">Vehicle  removed.</div>';
header('Location:allcars.php');


	}


}


?>