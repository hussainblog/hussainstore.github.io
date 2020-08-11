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

         
         <style>

          table{width:100%;}
          table,tr,th,td{border:1px solid black; text-align:center;}
          th{font-weight:bold; color:green;}
          th,td{vertical-align:middle;}

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
		<br>

		    <div class="clear"> </div>

		    
		    	
		    <div class="content-grids">

			<h1 style="text-align:center"> <font style="font-size:30px; font-weight:bold; color:green; text-decoration:underline;"> All Order Details </font> </h1>
            
			<br>
		    <table>
                  <tr>
                     <th> S.No</th>
                     <th> User</th>
                     <th> Due Amount</th>
                     <th> Invoice No</th>
                     <th> Total Products</th>
                     <th> Order Date</th>
                     <th> Paid/Unpaid</th>
					 <th> Status</th>
                  </tr>

				  <?php
				  
				  $email = $_SESSION['useremail'];
				  
				  $sn = 1;

				  $sel = mysqli_query($conn,"select * from customer_orders where user='$email'");
				  while($arr = mysqli_fetch_assoc($sel))
				  {

					if($arr['order_status']=='Pending')
					{
						$arr['order_status']='Unpaid';
					}
					else
					{
						$arr['order_status']='Paid';
					}

					  ?>
					  
					  <tr>

					  <td> <?php echo $sn?> </td>
					  <td> <?php echo $arr['user']?></td>
					  <td> <?php echo $arr['due_amount']?></td>
					  <td> <?php echo $arr['invoice_no']?></td>
					  <td> <?php echo $arr['total_products']?></td>
					  <td> <?php echo $arr['order_date']?></td>
					  <td> <?php echo $arr['order_status']?></td>
					  <td> <a href="confirm.php?orderid=<?php echo $arr['id']?>"> Confirm If Paid </a> </td>

					  </tr>
				  <?php
				  $sn++;

				  }
				  ?>

            </table>

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

