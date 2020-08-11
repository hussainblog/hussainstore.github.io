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
            
                <h1 style="text-align:center"> <font style="font-size:35px;color:green; font-weight:bold;"> Manage Your Account Here </font> </h1>
               
		<!--------Getting no of pending orders in customer orders table---->
                <?php
				
                $email = $_SESSION['useremail'];

                $sel = mysqli_query($conn,"select * from customer_orders where user='$email' AND order_status='Pending'");

                $count = mysqli_num_rows($sel);

                if($count>0)
                {
                    ?>
                    <div style="padding:20px; margin-left:10px;">
                        <h1> <font style="font-size:30px; color:red; font-weight:bold; text-decoration:underline;"> Important! </font> </h1>

                        <h2> <font style="font-size:20px; font-weight:bold;"> You Have <?php echo ($count)?> Pending Orders </font> </h2>

                        <h3> <font style="font-size:20px;"> Please see your order details by clicking this <a href="orderdetails.php" style="text-decoration:underline;"> LINK </a> <br> Or you can <a href="#" style="text-decoration:underline;"> Pay Offline Now </a> </font> </h3>

                    </div>
                <?php
				}
				else
				{
					?>
					<div style="padding:20px; margin-left:10px;">
                        <h1> <font style="font-size:30px; color:red; font-weight:bold; text-decoration:underline;"> Important! </font> </h1>

                        <h2> <font style="font-size:20px; font-weight:bold;"> You Have No Pending Orders! </font> </h2>

                        <h3> <font style="font-size:20px;"> Please see your order history by clicking this <a href="orderdetails.php" style="text-decoration:underline;"> LINK </a> </font> </h3>

                    </div>
				<?php
				}

                ?>
		    
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

