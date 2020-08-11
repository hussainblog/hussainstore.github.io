<?php
include("admin/connection.php");
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Hussain's Store</title>
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

		  <script>
		  $(document).ready(function()
		  {
			  $('.cart').click(function()
			  {
				  proid = $(this).attr('pid');
				  proquantity = $('.proquantity').val();

				  $.get("cartapi.php",{productid:proid,proquantity:proquantity},function(data)
				  {
					  alert(data);
					  //location.reload();
					  $('#headerreload').load("header.php");
				  })
			  })
		  })
		  </script>
	</head>
	<body>
		
	<!----------HEADER----------->
	   <label id="headerreload">
		<?php 
		include("header.php")
		?>
		</label>

		<div class="clear"> </div>
    

	<!-------------NAVBAR----------->
		<?php 
		include("navbar.php");
		?>
		
		<!----End-top-nav---->
		<!----End-Header---->
	<!--start-image-slider---->
		
		<?php 
		include("slider.php");
		?>

		    <div class="clear"> </div>

			<?php
			include("coming_soon.php");
			?>
		    
		    	
		    <div class="content-grids">
		    	<h4 style="font-weight:bold;">Deals of the day</h4>
		    	<div class="section group">

				<?php
				$sel = mysqli_query($conn,"select * from product order by pro_id desc limit 4");

				while($arr = mysqli_fetch_assoc($sel))
				{
					?>
					
                    <div class="grid_1_of_4 images_1_of_4 products-info">
					 <a href="productdetails.php?pid=<?php echo $arr['pro_id']?>"> <img src="admin/productimages/<?php echo $arr['image_front']?>" height="250" width="600"> </a>

					 <a href="single.html"> <?php echo $arr['modal_name']?> </a>
					 <h3 style="color:red; text-decoration:line-through;"> Rs <?php echo $arr['price']?> /-</h3>

					 <h3 style="color:orange"> <?php echo $arr['discount']?> %Off </h3>

					 <h3 style="color:green">Rs <?php echo number_format($arr['price']-($arr['price']*$arr['discount']/100))?>/- </h3>
                     
					 <input type="hidden" class="proquantity" value= "1" placeholder="Enter Quantity">

					 <ul>
					 	<li><a  class="cart" href="javascript:void()" pid=<?php echo $arr['pro_id']?>> </a></li>
					 	<li><a  class="i" href="single.html"> </a></li>
					 </ul>
				</div>

				<?php
				}
				?>

				
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

