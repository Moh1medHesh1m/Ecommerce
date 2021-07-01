<?php
session_start();
include "dbcon.php";

$mail=$_POST["email"];
$pass=$_POST["password"];
$usertype=$_POST['usertype'];

$query="select * from login where email= '$mail' and password= '$pass' and usertype='$usertype'  ";
$res=mysqli_query($con, $query);
if(mysqli_num_rows($res)>=1)
{
    while($rows = mysqli_fetch_array($res)){
    $_SESSION['username']= $rows["name"];    
    $_SESSION['usertype']= $rows["usertype"];
    $_SESSION['id']= $rows["id"];
    }
   echo '<script> alert("Logged in successfully") </script>';
    require "login.php";
  }else{
    session_destroy();

     echo '<script> alert("Invalid username/password") </script>';
    require "login.php";
    header("location: login.php" );
  }
mysqli_close($con);
if(isset($_SESSION['id'])&&isset($_SESSION['usertype']))
{
  if($_SESSION['usertype']=="admin"){
header("location: Admin dashboard/index.php");
  }else{
header("location: index.php" );
  }
}
?>
