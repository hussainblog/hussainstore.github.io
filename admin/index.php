<?php 

session_start();

include("connection.php");

extract($_POST);
if(isset($sub))
{

  $uname = mysqli_real_escape_string($conn,$uname);
  $pwd = mysqli_real_escape_string($conn,$pwd);

    $uname = trim($uname);
    $pwd   = trim($pwd);

    $uname_error = $pwd_error = "";
    $uname_valid = $pwd_valid = false;

    if(!empty($uname))
    {
      $format = "/^['a-zA-Z0-9']+@['a-zA-Z']+\.['a-zA-Z']{2,3}$/";
      if(preg_match($format,$uname))
      {
         $sel = mysqli_query($conn,"select * from admin where email='$uname'");
         $count = mysqli_num_rows($sel);
         if($count == 1)
         {
           $uname_valid = true;
         }
         else
         {
           $uname_error = "Email Not Exists!";
         }
      }
      else
      {
        $uname_error = "Invalid Email Address!";
      }
    
    }
    else
    {
      $uname_error = " Enter Email Address!";
    }


    //Password Validation....
    if(!empty($pwd))
    {
       if(strlen($pwd)>4 && strlen($pwd)<10)
       {
         $pwd_valid = true;
       }
       else
       {
         $pwd_error = "Password Must Be Between 4 To 10 Characters!";
       }
    }
    else
    {
      $pwd_error = "Enter Password!";
    }

    //IF No Error.....
    if($uname_valid && $pwd_valid == true)
    {
      $sel = mysqli_query($conn,"select * from admin where email = '$uname'");
      $arr = mysqli_fetch_assoc($sel);

      if(md5($pwd) == $arr['password'])
      {
        $_SESSION['username']=$arr['name'];
        $_SESSION['useremail']=$arr['email'];
        header("location:dashboard.php");
      }
      else
      {
         $pwd_error = "Incorrect Password!";
      }
    }
  
}

?>

<html>
     <head>
     <title> Admin Panel </title>

     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

     </head>

<body>

<header class="jumbotron"> <h1 class="text-center"> Admin Panel </h1> </header>

<section class="container">

<form action="" method="post">
  <div class="form-group">
    <label for="email" class="text-primary"> <b> UserEmail: </b> </label>
    <input type="email" class="form-control" placeholder="Enter email" id="email" name="uname">
   
   <?php
   if(isset($uname))
   {
     echo "<lable class='text-danger'> $uname_error </lable>";
   }
   ?>
  </div>

  <div class="form-group">
    <label for="pwd" class="text-primary"> <b> Password: </b> </label>
    <input type="password" class="form-control" placeholder="Enter password" id="pwd" name="pwd">
    <lable id="eye" class="glyphicon glyphicon-eye-close"  onclick="changeeye()"></lable>
    <?php
   if(isset($pwd))
   {
     echo "<lable class='text-danger'> $pwd_error </lable>";
   }
   ?>
  </div>
  
  <button type="submit" class="btn btn-primary" name="sub">Submit</button>
</form>


</section>

</body>

</html>