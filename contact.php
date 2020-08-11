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
            
            <div class="section group">				
				<div class="col span_1_of_3">
					<div class="contact_info">
			    	 	<h2>Find Us Here</h2>
			    	 		<div class="map">
                             <iframe width="100%" height="175" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3504.0909535703186!2d77.32321691440558!3d28.567031393794718!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce44977e862ab%3A0x8db2f2a2c85f5957!2sThe%20Great%20India%20Place%20Sector%2018%20Noida!5e0!3m2!1sen!2sin!4v1590464244618!5m2!1sen!2sin" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe><br><small><a href="https://maps.google.co.in/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Lighthouse+Point,+FL,+United+States&amp;aq=4&amp;oq=light&amp;sll=26.275636,-80.087265&amp;sspn=0.04941,0.104628&amp;ie=UTF8&amp;hq=&amp;hnear=Lighthouse+Point,+Broward,+Florida,+United+States&amp;t=m&amp;z=14&amp;ll=26.275636,-80.087265" style="color:#666;text-align:left;font-size:12px">View Larger Map</a></small>

					   		</div>
      				</div>
      			<div class="company_address">
				     	<h2>Company Information :</h2>
						    	<p>500 Lorem Ipsum Dolor Sit,</p>
						   		<p>22-56-2-9 Sit Amet, Lorem,</p>
						   		<p>USA</p>
				   		<p>Phone:(00) 222 666 444</p>
				   		<p>Fax: (000) 000 00 00 0</p>
				 	 	<p>Email: <span><a href="mailto:info@mycompany.com">info@mycompany.com</a></span></p>
				   		<p>Follow on: <span><a href="#">Facebook</a></span>, <span><a href="#">Twitter</a></span></p>
				   </div>
				</div>				
				<div class="col span_2_of_3">
				  <div class="contact-form">

				  <?php
				  
				  extract($_POST);
				  if(isset($sub))
				  {
					  $un = trim($un);
					  $em = trim($em);
					  $mn = trim($mn);
					  $subject = trim($subject);

					  $un_error = $em_error = $mn_error = $subject_error = "";

					  $un_valid = $em_valid = $mn_valid = $subject_valid = false;

					  if(!empty($un))
					  {
						 $format = "/^['a-zA-Z ']+$/";
						 if(preg_match($format,$un))
						 {
                             $un_valid = true;
						 }
						 else
						 {
							 $un_error = "Name Contains Only Alphabetic Values";
						 }
					  }
					  else
					  {
						  $un_error = "Enter Your Name";
					  }

					  
					  // Email Validation....
					  if(!empty($em))
					  {
						  $format = "/^['a-zA-Z0-9']+@['a-zA-Z']+\.[a-zA-Z]{2,3}$/";
						  if(preg_match($format,$em))
						  {
                              $em_valid = true;
						  }
						  else
						  {
							  $em_error = "Invalid Email Address";
						  }
					  }
					  else
					  {
						  $em_error = "Enter Your Email ID";
					  }


					  // Mobile Number Validation...
					  if(!empty($mn))
					  {
						 $format = "/^['6-9']{1}['0-9']{9}$/";
						 if(preg_match($format,$mn))
						 {
                             $mn_valid = true;
						 }
						 else
						 {
							 $mn_error = "Incorrect Mobile Numbers";
						 }
					  }
					  else
					  {
						  $mn_error = "Enter Your Mobile Number";
					  }


					  // Subject Validation....
					  if(!empty($subject))
					  {
						  $format = "/^['a-zA-Z0-9,. ']{1,300}$/";
						  if(preg_match($format,$subject))
						  {
                              $subject_valid = true;
						  }
						  else
						  {
							  $subject_error = "Subject Must Be Between 200 characters & In Special Characters(Fullstop & Comma Allowed)";
						  }
					  }
					  else
					  {
						  $subject_error = "Enter Your Subject";
					  }

					  
					  // If No Error....
					  if($un_valid && $em_valid && $mn_valid && $subject_valid == true)
					  {
						  if(mysqli_query($conn,"insert into feedback(name, email, mobile, subject) values('$un', '$em', '$mn', '$subject')"))
						  {
                              echo "<script> alert('Message Send Successfully') </script>";
						  }
						  else
						  {
							  echo "<script> alert('Message Sending Error')</script>";
						  }
					  }
				  }

				  ?>

				  	<h2>Contact Us</h2>
					    <form method="post">
					    	<div>
						    	<span><label>NAME</label></span>
						    	<span><input type="text" name="un" value=""></span>
								<?php 
								if(isset($un_error))
								{
									?>
									<lable style="color:red;"> <?php echo $un_error?></lable>
								<?php
								}
								?>

						    </div>

						    <div>
						    	<span><label>E-MAIL</label></span>
						    	<span><input type="text" name="em" value=""></span>
								<?php 
								if(isset($em_error))
								{
									?>
									<lable style="color:red;"> <?php echo $em_error?></lable>
								<?php
								}
								?>

						    </div>

						    <div>
						     	<span><label>MOBILE.NO</label></span>
						    	<span><input type="text" name="mn" value=""></span>
								<?php 
								if(isset($mn_error))
								{
									?>
									<lable style="color:red;"> <?php echo $mn_error?></lable>
								<?php
								}
								?>

						    </div>
						    <div>
						    	<span><label>SUBJECT</label></span>
						    	<span><textarea name="subject"> </textarea></span>
								<?php 
								if(isset($subject_error))
								{
									?>
									<lable style="color:red;"> <?php echo $subject_error?></lable>
								<?php
								}
								?>

						    </div>
						   <div>
						   		<span><input type="submit" name="sub" value="Submit"></span>
						  </div>
					    </form>
				    </div>
  				</div>				
			  </div>
		    
		    	</div>


		    </div>
		    <div class="clear"> </div>
		    </div>

          <!------- FOOTER ------------>
			<?php 
			include("footer.php");
			?>
	
	</body>
</html>

