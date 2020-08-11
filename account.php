<?php
include("admin/connection.php");

session_start();
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

           <?php
           
           $email = $_SESSION['useremail'];

           $sel = mysqli_query($conn,"select * from user_register where email = '$email'");

		   $arr = mysqli_fetch_assoc($sel);
		   
		   // Update Account....
		   extract($_POST);
		   if(isset($sub))
		   {
			   $fn = $_FILES['att']['name'];
			   $tmp = $_FILES['att']['tmp_name'];
			   $oldimg = $arr['image'];

			   if(empty($fn))
			   {
				   mysqli_query($conn,"update user_register set name='$un', email='$em', password='$pass', mobile='$mn', address='$add', city='$city', pincode='$pcode' where email = '$email'");

				   $success = "Account Updated Successfully";
				   
			   }
			   else
			   {
				   $ext = pathinfo($fn,PATHINFO_EXTENSION);
				   $ext = strtolower($ext);

				   if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png')
				   {
					   $fnn = uniqid().'.'.$ext;
					   if(move_uploaded_file($tmp,"userimages/".$fnn))
					   {
						   if(mysqli_query($conn,"update user_register set name='$un', email='$em', password='$pass', mobile='$mn', address='$add', city='$city', pincode='$pcode', image='$fnn' where email='$email'"))
						   {
                               $success = "Account Updated Successfully";
						   }
						   else
						   {
							   unlink("userimages/".$oldimg);
							   $error = mysqli_error($conn);
						   }
					   }
					   else
					   {
						   $error = "File Uploading Error";
					   }
				   }
				   else
				   {
					   $error = "Invalid File Type";
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

				<input type="text" name="un" value="<?php echo $arr['name']?>" placeholder="username"/>

				<input type="text" name="em" value="<?php echo $arr['email']?>" placeholder="email"/>

				<input type="text" name="pass" value="<?php echo $arr['password']?>" placeholder="password"/>

				<input type="number" name="mn" value="<?php echo $arr['mobile']?>" placeholder="mobile number"/>

			    <input type="text" name="add" value="<?php echo $arr['address']?>" placeholder="address"/>

				<input type="text" name="city" value="<?php echo $arr['city']?>" placeholder="city"/>

				<input type="number" name="pcode" value="<?php echo $arr['pincode']?>" placeholder="pin code"/>

				<input type="file" name="att" placeholder="Image"/>
                <img src="userimages/<?php echo $arr['image']?>" height="40" width="40">

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

