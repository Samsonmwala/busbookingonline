<?php
session_start();
include('conn.php');

if(isset($_POST['adduser'])){
  $fname=$_POST['fname'];
  $lname=$_POST['lname'];
  $email=$_POST['email'];
  $phone=$_POST['phone'];
  $pass1=$_POST['pass1'];
  $pass2=$_POST['pass2'];
  $date=date('d/m/Y');

      $check="select * from users where email='$email'";
      $run=$conn->query($check);
        if($row=$run->num_rows > 0){
          $_SESSION['user_error']='<div class="alert alert-danger">Email address already in use</div>';
          header('Location:add_user.php');

        }else{
          //check passwords
          if($pass2!==$pass1){
             $_SESSION['user_error']='<div class="alert alert-danger">Passwords do not match </div>';
            header('Location:add_user.php');

          }else{
            $insert="insert into users values('','$fname','$lname','$email','admin','blantyre','admin','$phone','$date')";
            $run=$conn->query($insert);

            $id="select * from users order by id desc limit 1";
            $runid=$conn->query($id);
            $details=$runid->fetch_assoc();

            $userid=$details['id'];
            $password=md5($pass2);

            $login="insert into login values('$userid','$email','$password','admin','approved')";
            $runloign=$conn->query($login);
            $_SESSION['user_error']='<div class="alert alert-success">User added Successfuly</div>';
            header('Location:add_user.php');


          }

        }



}else if(isset($_GET['deluser'])){
  $id=$_GET['deluser'];
  $delete="delete from users where id= '$id'";
  

  $delete2="delete from login where userid='$id'";

  if($run2=$conn->query($delete2)===TRUE && $run1=$conn->query($delete)===TRUE){

            $_SESSION['user_error']='<div class="alert alert-success">User Deleted Successfuly</div>';
            header('Location:users.php');

  }else{
            $_SESSION['user_error']='<div class="alert alert-danger">User Delete Failed</div>';
            header('Location:users.php');

  }



}else if(isset($_POST['update_profile'])){
$userid=$_POST['userid'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$pass=$_POST['pass'];
$passwor=md5($pass);
  
  $update="update users set email='$email' ,phone='$phone' where id='$userid'";
  

  $login="update login set username='$email', password='$password' where userid='$user'";
  

  if($runlogin=$conn->query($login)===TRUE && $runupdate=$conn->query($update)===TRUE){
            $_SESSION['user_error']='<div class="alert alert-success">User Updated Successfuly</div>';
            header('Location:update_profile.php');
  }else{
          $_SESSION['user_error']='<div class="alert alert-danger">User Updated Failed</div>';
            header('Location:update_profile.php');

  }

}

 ?>