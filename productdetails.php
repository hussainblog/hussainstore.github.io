<?php
include("admin/connection.php");
?>

<!DOCTYPE HTML>
<html>
	<head>
    <title>Mobilestore Website Template | single :: W3layouts</title>
		<link href="css/style.css" rel="stylesheet" type="text/css"  media="all" />
		<meta name="keywords" content="Mobilestore iphone web template, Android web template, Smartphone web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
		<link href='//fonts.googleapis.com/css?family=Londrina+Solid|Coda+Caption:800|Open+Sans' rel='stylesheet' type='text/css'>
		<script src="js/jquery.min.js"></script>
		<script src="js/jqzoom.pack.1.0.1.js" type="text/javascript"></script>
		<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
		<script src="js/imagezoom.js"></script>
		<!-- FlexSlider -->
					<script defer src="js/jquery.flexslider.js"></script>
					<script>
						// Can also be used with $(document).ready()
						$(window).load(function() {
						  $('.flexslider').flexslider({
							animation: "slide",
							controlNav: "thumbnails"
						  });
						});
					</script>
					<!----->
					<script>
		$(document).ready(function(){
			$(".menu_body").hide();
			//toggle the componenet with class menu_body
			$(".menu_head").click(function(){
				$(this).next(".menu_body").slideToggle(600); 
				var plusmin;
				plusmin = $(this).children(".plusminus").text();
				
				if( plusmin == '+')
				$(this).children(".plusminus").text('-');
				else
				$(this).children(".plusminus").text('+');
			});
		});
		</script>

        <style>
        table,tr,th,td{border:1px solid black;}
        table{width:100%};
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

        <div class="clear"> </div>
		
		<!----End-top-nav---->
		<!----End-Header---->
	<!--start-image-slider---->

   <!--------- Get Product By Product ID------------->
    <?php 
    
    $productid = $_GET['pid'];
    //echo $productid;
    
    ?>
		

		    <div class="clear"> </div>
		    
		    	
		    <div class="content-grids">

            <?php 
			$sel = mysqli_query($conn,"select * from product where pro_id='$productid'");
			
			if(mysqli_num_rows($sel)==0)
			{
                header("location:404.php");
			}

            $arr = mysqli_fetch_assoc($sel);
            ?>

		    	<div class="details-page">
		    		<div class="back-links">
		    			<ul>
		    				<li><a href="index.php">Home</a><img src="images/arrow.png" alt=""></li>
                            <li><a href="#">Product</a><img src="images/arrow.png" alt=""></li>
		    				<li><a href="#"> <?php echo $arr['modal_name']?></a><img src="images/arrow.png" alt=""></li>
		    			</ul>
		    		</div>
		    	</div>
		    	<div class="detalis-image">
		    		<div class="flexslider">
						<ul class="slides">
							<li data-thumb="admin/productimages/<?php echo $arr['image_front']?>">
								<div class="thumb-image"> <img src="admin/productimages/<?php echo $arr['image_front']?>" data-imagezoom="true" class="img-responsive" alt="" /> </div>
							</li>
							<li data-thumb="admin/productimages/<?php echo $arr['image_side']?>">
								<div class="thumb-image"> <img src="admin/productimages/<?php echo $arr['image_side']?>" data-imagezoom="true" class="img-responsive" alt="" /> </div>
							</li>
							<li data-thumb="admin/productimages/<?php echo $arr['image_back']?>">
								<div class="thumb-image"> <img src="admin/productimages/<?php echo $arr['image_back']?>" data-imagezoom="true" class="img-responsive" alt="" /> </div>
							</li>
						</ul>
					</div>
		    	</div>
		    	<div class="detalis-image-details">
		    		
		    		<div class="brand-value">
		    			<h3>Product- <?php echo $arr['modal_name']?> Complete Details With Value</h3>
		    			<div class="left-value-details">
			    			<ul>
			    				<li>Price:</li>
			    				<li><span> <?php echo number_format($arr['price'])?></span></li>
			    				<li><h5> <?php echo number_format($arr['price'] - ($arr['price']*$arr['discount']/100))?></h5></li>
			    				<br />
			    				<li><p>Not rated</p></li>
			    			</ul>
		    			</div>
		    			<div class="right-value-details">

                        <?php 
                        if($arr['quantity']>0)
                        {
                            ?>
                            <a href="#">InStock</a>
                        <?php
                        }
                        else
                        {
                            ?>
                            <a href="#">OutOfStock</a>
                        <?php
                        }
                        ?>
			    			
			    			<p>No reviews</p>
		    			</div>
		    			<div class="clear"> </div>
		    		</div>
		    		<div class="brand-history">
		    			<h2>Description :</h2>
		    			<p> <?php echo $arr['description']?></p>

                        <h2> Specifications: </h2>

                        <table>
                             <tr>
                             <td> Processor</td>
                             <td> <?php echo $arr['processor']?></td>
                             </tr>

                             <tr>
                             <td> Ram</td>
                             <td> <?php echo $arr['ram']?></td>
                             </tr>

                             <tr>
                             <td> Operating System</td>
                             <td> <?php echo $arr['operating_system']?></td>
                             </tr>

                             <tr>
                             <td> Color</td>
                             <td> <?php echo $arr['color']?></td>
                             </tr>

                             <tr>
                             <td> Weight</td>
                             <td> <?php echo $arr['weight']?></td>
                             </tr>

                             <tr>
                             <td> Display</td>
                             <td> <?php echo $arr['display']?></td>
                             </tr>

                             <tr>
                             <td> Warranty</td>
                             <td> <?php echo $arr['warranty']?></td>
                             </tr>

                             <tr>
                             <td> Battery</td>
                             <td> <?php echo $arr['battery']?></td>
                             </tr>

                        </table>

		    		</div>
		    		<div class="share">
		    			<ul>
		    				<li> <a href="#"><img src="images/facebook.png" title="facebook" /> Facebook</a></li>
		    				<li> <a href="#"><img src="images/twitter.png" title="Twiiter" />Twiiter</a></li>
		    				<li> <a href="#"><img src="images/rss.png" title="Rss" />Rss</a></li>
		    			</ul>
		    		</div>
		    		<div class="clear"> </div>
		    		
		    		</div>
		    		<div class="clear"> </div>

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

