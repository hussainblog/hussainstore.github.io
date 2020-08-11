<?php
ob_start();

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
		
		<!----End-top-nav---->
		<!----End-Header---->
	<!--start-image-slider---->

		    <div class="clear"> </div>

		    <h2 style="font-size:30px; color:green; text-decoration:underline; font-weight:bold;"> Cart Details</h2>
		    	
		    <div class="content-grids">

        <br>

            <table>

            <?php
            
            if(isset($_SESSION['useremail']))
            {
                $userid = $_SESSION['useremail'];
            }
            else
            {
                $userid = session_id();
            }

            $sel = mysqli_query($conn,"select * from addcart where user = '$userid'");

            if(mysqli_num_rows($sel)>0)
            {
                ?>
                     <tr>
                     <th> S.No</th>
                     <th> Product Name</th>
                     <th> Image</th>
                     <th> Price</th>
                     <th> Discount</th>
                     <th> Discount Price</th>
                     <th> Quantity</th>
                     <th> Total Price</th>
                     <th> Remove</th>
                     </tr>

            <?php

            $sn = 1;
            $grandtotal = 1;
             while($arr = mysqli_fetch_assoc($sel))
             {
                 $productid = $arr['product_id'];
                 
                 $sel2 = mysqli_query($conn,"select * from product where pro_id = '$productid'");
                 
                 $arr2 = mysqli_fetch_assoc($sel2);

                 $discountprice = $arr2['price']-$arr2['price']*$arr2['discount']/100;

                 $totalprice = $arr2['price']*$arr['quantity'];

                 $grandtotal = $grandtotal+$totalprice;

                 ?>
                 
                 <tr>
                    <td> <?php echo $sn?></td>
                    <td> <?php echo $arr2['modal_name']?></td>
                    <td> <img src="admin/productimages/<?php echo $arr2['image_front']?>" height="50" width="50"></td>
                    <td> Rs <?php echo number_format($arr2['price'])?>/-</td>
                    <td> <?php echo $arr2['discount']?>%</td>
                    <td> <?php echo number_format($discountprice)?></td>
                    <td> <a href="cartdetails.php?cartid=<?php echo $arr['id']?>&& cartquan=<?php echo $arr['quantity']?>">+</a> 
                    <?php echo $arr['quantity']?> <a href="cartdetails.php?cid=<?php echo $arr['id']?>&& cquan=<?php echo $arr['quantity']?>">-</a> </td>

                    <td> <?php echo number_format($totalprice)?></td>
                    <td> <a href="cartdelete.php?cid=<?php echo $arr['id']?>"> Delete </a></td>
                 </tr>
            <?php
            $sn++;
             }

             ?>
             
             <tr>
             <th Colspan="7"> Grand Total</th>
             <th> <?php echo number_format($grandtotal)?></th>
             </tr>

            <?php

            }
            else
            {
              ?>
                <h2 style="font-size:50px; text-align:center;"> Empty Cart...</h2>
            <?php
            }

            ?>

            </table>

            <br> <br>

            <?php
            
            if(mysqli_num_rows($sel)>0)
            {
               ?>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <button> <a href="index.php" style="color:green; "> Continue Shopping </a></button>
              
  
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  
              <button> <a href="checkout.php" style="color:green"> Checkout <a> </button>

            <?php
            }
            
            ?>
            
            
          

          <!-------------Quantity Increase------------------>
            <?php
            if(isset($_GET['cartid']) && isset($_GET['cartquan']))
            {
              $cartid = $_GET['cartid'];
              $cartquan = $_GET['cartquan'];

               mysqli_query($conn,"update addcart set quantity='$cartquan'+1 where id='$cartid'");
            }
            ?>
          
          <!----------Quantity Decrease---------------->
          <?php

            if(isset($_GET['cid']) && isset($_GET['cquan']))
            {
              $cid = $_GET['cid'];
              $cquan = $_GET['cquan'];

               mysqli_query($conn,"update addcart set quantity='$cquan'-1 where id='$cid'");
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

