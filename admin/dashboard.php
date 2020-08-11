<?php

include("connection.php");

session_start();

// If User Not Login...
$user = $_SESSION['username'];
if(empty($user))
{
  header("location:index.php");
}


$pageconnect = true;

?>

<html>

<head>
<title> Dashboard </title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>

<body>

<header>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#"> WebSiteName </a>

  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="dashboard.php"> Home </a>
    </li>

    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Welcome: <?php echo $user; ?>
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="dashboard.php?dash=password"> Change Password</a>
        <a class="dropdown-item" href="logout.php"> Logout</a>
      </div>
    </li>
  </ul>
</nav>

</header>
<br>

<aside class="col-sm-3">
 
<div class="list-group">
  <a href="dashboard.php?dash=category" class="list-group-item list-group-item-action list-group-item-success"> Category </a>
  <a href="dashboard.php?dash=product" class="list-group-item list-group-item-action list-group-item-secondary"> Product </a>
  <a href="#" class="list-group-item list-group-item-action list-group-item-info"> Order </a>
  <a href="dashboard.php?dash=feedback" class="list-group-item list-group-item-action list-group-item-warning"> Feedback</a>
</div>

</aside>
<section class="col-sm-9">
<?php
if(isset($_GET['dash']))
{
  switch($_GET['dash'])
  {
    case 'category' : include("category.php");
                     break;

    case 'product' : include("product.php");
                     break;

    case 'password': include("changepass.php");
                    break;

    case 'addpro' : include("addproduct.php");
                     break;
                    
    case 'editpro' : include("editproduct.php");
                    break;

    case 'feedback' : include("feedback.php");
                   break;
  }
}
?>


</section>
</body>

</html>