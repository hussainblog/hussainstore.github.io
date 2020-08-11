<?php

@session_start();

?>

<div class="wrap">
		<!----start-Header---->
<div class="header">
			<div class="search-bar">
				<form method="post" action="search.php">
					<input type="text" name="sear"><input type="submit" value="Search"/>
				</form>
			</div>
			<div class="clear"> </div>
			<div class="header-top-nav">
				<ul>
				
				<?php 
				if(empty($_SESSION['name']))
				{
					?>
				     
					<li><a href="register.php">Register</a></li>
					<li><a href="login.php">Login</a></li>

				<?php
				}
				else
				{
					?>
                    
					<li><a href="#" style="color:brown;"> Welcome :  <?php echo $_SESSION['name']?> </a>  <img src="userimages/<?php echo $_SESSION['image']?>" height="20" width="20"> </li>
					<li><a href="logout.php"> Logout </a></li>
					<li><a href="account.php">My account</a></li>

				<?php
				}
				?>
				
					<li><a href="#">Checkout</a></li>

                <!--------Add to Cart Showing Items In front of the shopping cart--------->

				<?php
				if(isset($_SESSION['useremail']))
				{
                    $userid = $_SESSION['useremail'];
				}
				else
				{
                    $userid = session_id();
				}
				
				include("admin/connection.php");
				$sel = mysqli_query($conn,"select * from addcart where user = '$userid'");
				?>

					<li><a href="cartdetails.php"><span>shopping cart&nbsp;&nbsp;: </span></a><label> <?php echo $count = mysqli_num_rows($sel); ?> items</label></li>
				</ul>
			</div>
			<div class="clear"> </div>
		</div>
		</div>