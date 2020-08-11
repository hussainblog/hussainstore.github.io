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
		
		<?php 
		include("slider.php");
		?>

		    <div class="clear"> </div>

            <?php
            include("coming_soon.php");
            ?>

            <?php
            
            $catid = $_GET['cid'];
            $catname = $_GET['cname'];
            //echo $catid,$catname;
            
            ?>
		    
		    	
		    <div class="content-grids">
		    	<h4> <?php echo $catname?>  Products</h4>
		    	<div class="section group">

                <?php 
				$sel = mysqli_query($conn,"select * from product where pro_cat='$catid'");
				
				if(mysqli_num_rows($sel)==0)
				{
					header("location:404.php");
				}

                while($arr = mysqli_fetch_assoc($sel))
                {
                    ?>

                    <div class="grid_1_of_4 images_1_of_4 products-info">
                    <img src="admin/productimages/<?php echo $arr['image_front']?>" height="200" width="700">
                    <a href="single.html"> <?php echo $arr['modal_name']?> </a>
                    <h3 style="color:red; text-decoration:line-through;"> Rs <?php echo $arr['price']?> /-</h3>

                    <h3 style="color:orange"> <?php echo $arr['discount']?> %Off </h3>

                    <h3 style="color:green">Rs <?php echo number_format($arr['price']-($arr['price']*$arr['discount']/100))?>/- </h3>
                    <ul>
                        <li><a  class="cart" href="single.html"> </a></li>
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

