<?php
include("connection.php");

session_start();

$loginuser = $_SESSION['useremail'];

if(isset($_GET['oldpass']) && isset($_GET['newpass']))
{
    $oldpass = $_GET['oldpass'];
    $newpass = $_GET['newpass'];

     $sel = mysqli_query($conn,"select * from admin where email = '$loginuser'");

     $arr = mysqli_fetch_assoc($sel);
     
     $newpass = md5($newpass);
     if(md5($oldpass) == $arr['password'])
     {
         mysqli_query($conn,"update admin set password = '$newpass' where email = '$loginuser'");

         echo "Password Updated Successfully";

     }
     else
     {
         echo "Old Password didn't Match With The Existing Password";
     }
}

?>