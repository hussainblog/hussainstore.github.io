<?php
include("admin/connection.php");
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Mobilestore Website Template | Home :: W3layouts</title>
		<link href="css/style.css" rel="stylesheet" type="text/css"  media="all" />
		<meta name="keywords" content="Mobilestore iphone web template, Android web template, Smartphone web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
		<link href='//fonts.googleapis.com/css?family=Londrina+Solid|Coda+Caption:800|Open+Sans' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/responsiveslides.css">
		<script src="js/jquery.min.js"></script>
		<script src="js/responsiveslides.min.js"></script>
		  <script>
		    // You can also use "$(window).load(function() {"
			    $(function () {
			
			      // Slideshow 1
			      $("#slider1").responsiveSlides({
			        maxwidth: 1600,
			        speed: 600
			      });
			});
		  </script>

<style type="text/css">
		  	
		  	/* login form css */

		  	@import url(https://fonts.googleapis.com/css?family=Roboto:300);

			.login-page {
			  width: 360px;
			  padding: 8% 0 0;
			  margin: auto;
			}
			.form {
			  position: relative;
			  z-index: 1;
			  background: #FFFFFF;
			  max-width: 360px;
			  margin: 0 auto 100px;
			  padding: 45px;
			  text-align: center;
			  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
			}
			.form input {
			  font-family: "Roboto", sans-serif;
			  outline: 0;
			  background: #f2f2f2;
			  width: 100%;
			  border: 0;
			  margin: 0 0 15px;
			  padding: 15px;
			  box-sizing: border-box;
			  font-size: 14px;
			}
			.form button {
			  font-family: "Roboto", sans-serif;
			  text-transform: uppercase;
			  outline: 0;
			  background: #4CAF50;
			  width: 100%;
			  border: 0;
			  padding: 15px;
			  color: #FFFFFF;
			  font-size: 14px;
			  -webkit-transition: all 0.3 ease;
			  transition: all 0.3 ease;
			  cursor: pointer;
			}
			.form button:hover,.form button:active,.form button:focus {
			  background: #43A047;
			}
			.form .message {
			  margin: 15px 0 0;
			  color: #b3b3b3;
			  font-size: 12px;
			}
			.form .message a {
			  color: #4CAF50;
			  text-decoration: none;
			}
			.form .register-form {
			  display: none;
			}
			.container {
			  position: relative;
			  z-index: 1;
			  max-width: 300px;
			  margin: 0 auto;
			}
			.container:before, .container:after {
			  content: "";
			  display: block;
			  clear: both;
			}
			.container .info {
			  margin: 50px auto;
			  text-align: center;
			}
			.container .info h1 {
			  margin: 0 0 15px;
			  padding: 0;
			  font-size: 36px;
			  font-weight: 300;
			  color: #1a1a1a;
			}
			.container .info span {
			  color: #4d4d4d;
			  font-size: 12px;
			}
			.container .info span a {
			  color: #000000;
			  text-decoration: none;
			}
			.container .info span .fa {
			  color: #EF3B3A;
			}
			


		  </style>
          
	</head>
	<body>
		
	<!----------HEADER----------->
		<?php 
		include("header.php")
		?>

		<div class="clear"> </div>
    

	<!-------------NAVBAR----------->
		<?php 
		include("navbar.php");
		?>
		
		<!----End-top-nav---->
		<!----End-Header---->
	<!--start-image-slider---->

		    <div class="clear"> </div>

		    
		    	
		    <div class="content-grids">
            <div class="login-page">

		<!--------Register Validation-------->

			<?php
			
			extract($_POST);
			if(isset($sub))
			{
				$un   = trim($un);
				$em   = trim($em);
				$pass = trim($pass);
				$mn   = trim($mn);
				$add  = trim($add);
				$city = trim($city);
				$pcode = trim($pcode);

				$unerror = $emerror = $passerror = $mnerror = $adderror = $cityerror = $pcodeerror = $imgerror = "";

				$un_valid = $em_valid = $pass_valid = $mn_valid = $add_valid = $city_valid = $pcode_valid = $img_valid = false;

				if(!empty($un))
				{
					$format = "/^['a-zA-Z0-9 ']+$/";
					if(preg_match($format,$un))
					{
                       $un_valid = true;
					}
					else
					{
						$unerror = "Username Contains Only Alphabets & Numeric Values";
					}
				}
				else
				{
					$unerror = "Enter Username";
				}

				
				// Email Validation........
				if(!empty($em))
				{
				   $format = "/^['a-zA-Z0-9']+@['a-zA-Z']+\.['a-zA-Z']{2,3}$/";
				   if(preg_match($format,$em))
				   {
						$sel = mysqli_query($conn,"select email from user_register where email = '$em'");

						$count = mysqli_num_rows($sel);
						if($count == 0)
						{
                            $em_valid = true;
						}
						else
						{
							$emerror = "Email Already Exists";
						}
				   }
				   else
				   {
					   $emerror = "Invalid Email Address";
				   }
				}
				else
				{
					$emerror = "Enter Your Email ID";
				}

				
				// Password Validation.....
				if(!empty($pass))
				{
					if(strlen($pass)>4 && strlen($pass)<10)
					{
                        $pass_valid = true;
					}
					else
					{
						$passerror = "Password Must Be Between 6 To 10 Characters";
					}
				}
				else
				{
					$passerror = "Enter Your Password";
				}

				
				// Mobile Number Validation....
				if(!empty($mn))
				{
					if(strlen($mn)==10)
					{
					   $sel = mysqli_query($conn,"select mobile from user_register where mobile = '$mn'");
					   
					   $count = mysqli_num_rows($sel);
					   if($count == 0)
					   {
                           $mn_valid = true;
					   }
					   else
					   {
						   $mnerror = "Mobile Number Already Exists";
					   }
					}
					else
					{
						$mnerror = "Invalid Mobile Number";
					}
				}
				else
				{
					$mnerror = "Enter Your Mobile Number";
				}

				
				// Address Validation.....
				if(!empty($add))
				{
					$format = "/^['a-zA-Z0-9. ']+$/";
					if(preg_match($format,$add))
					{
                        $add_valid = true;
					}
					else
					{
						$adderror = "Invalid Residential Address";
					}
				}
				else
				{
					$adderror = "Enter Residential Address";
				}

				
				// City Validation...
				if(!empty($city))
				{
					$format = "/^['a-zA-Z']+$/";
					if(preg_match($format,$city))
					{
                        $city_valid = true;
					}
					else
					{
						$cityerror = "Invalid City Name";
					}
				}
				else
				{
					$cityerror = "Enter Your Current City Name";
				}

				
				// Pincode Validation....
				if(!empty($pcode))
				{
				   $format = "/^['0-9']{3,6}$/";
				   if(preg_match($format,$pcode))
				   {
                       $pcode_valid = true;
				   }
				   else
				   {
					   $pcodeerror = "Invalid Pincode";
				   }
				}
				else
				{
					$pcodeerror = "Enter Your Pincode";
				}

				
				// Image Validation....
				$fn = $_FILES['att']['name'];
				$tmp = $_FILES['att']['tmp_name'];

				if(!empty($fn))
				{
					$ext = pathinfo($fn,PATHINFO_EXTENSION);
					$ext = strtolower($ext);

					if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png')
					{
                        $img_valid = true;
					}
					else
					{
						$imgerror = "Invalid File Type";
					}
				}
				else
				{
					$imgerror = "Select Image";
				}

				
				// If No Error.....
				if($un_valid && $em_valid && $pass_valid && $mn_valid && $add_valid && $city_valid && $pcode_valid && $img_valid == true)
				{
					$fnn = uniqid().'.'.$ext;
					if(move_uploaded_file($tmp,"userimages/".$fnn))
					{
						if(mysqli_query($conn,"insert into user_register(name,email,password,mobile,address,city,pincode,image) values('$un','$em','$pass','$mn','$add','$city','$pcode','$fnn')"))
						{
                            $success = "Account Created Successfully";
						}
						else
						{
							unlink("userimages/".$fnn);
							$error = mysqli_error($conn);
						}
					}
					else
					{
						$error = "File Uploading Error";
					}
				}
			}

			?>


	     <!-------Error Message---------->
		 <?php
		 if(isset($error))
		 {
			 ?>
			 <lable style="color:red"> <?php echo $error?></lable>
		<?php
		 }
		 ?>

		 <!-------Success Message---------->
		 <?php
		 if(isset($success))
		 {
			 ?>
			 <lable style="color:green"> <?php echo $success?></lable>
		<?php
		 }
		 ?>

			<div class="form">

			<form class="login-form" method="post" enctype="multipart/form-data">

				<input type="text" name="un" placeholder="username"/>
				<?php
				if(isset($unerror))
				{
					?>
					<lable style="color:red;"> <?php echo $unerror?> </lable>
				<?php
				}
				?>

				<input type="text" name="em" placeholder="email"/>
				<?php 
				if(isset($emerror))
				{
					?>
					<lable style="color:red;"> <?php echo $emerror?></lable>
				<?php
				}
				?>

				<input type="password" name="pass" placeholder="password"/>
				<?php 
				if(isset($passerror))
				{
					?>
					<lable style="color:red"> <?php echo $passerror?></lable>
				<?php
				}
				?>

				<input type="number" name="mn" placeholder="mobile number"/>
				<?php 
				if(isset($mnerror))
				{
					?>
					<lable style="color:red"> <?php echo $mnerror?> </lable>
				<?php
				}
				?>

			    <input type="text" name="add" placeholder="address"/>
				<?php
				if(isset($adderror))
				{
					?>
					<lable style="color:red"> <?php echo $adderror?></lable>
				<?php
				}
				?>

				<input type="text" name="city" placeholder="city"/>
				<?php 
				if(isset($cityerror))
				{
					?>
					<lable style="color:red"> <?php echo $cityerror?></lable>
				<?php
				}
				?>

				<input type="number" name="pcode" placeholder="pin code"/>
				<?php
				if(isset($pcodeerror))
				{
					?>
					<lable style="color:red"> <?php echo $pcodeerror?></lable>
				<?php
				}
				?>

				<input type="file" name="att" placeholder="Image"/>
				<?php
				if(isset($imgerror))
				{
					?>
					<lable style="color:red"> <?php echo $imgerror?></lable>
				<?php
				}
				?>

				<button type="submit" name="sub">Register</button>

				<p class="message">Already registered? <a href="login.php">Login</a></p>

				</form>

					</div>

					</div>
		    
		    	</div>
        
                
		    
			<!----------SIDEBAR------------>
				<?php 
				include("side.php");
				?>

		    </div>
		    <div class="clear"> </div>
		    </div>

          <!------- FOOTER ------------>
			<?php 
			include("footer.php");
			?>
	
	</body>
</html>

