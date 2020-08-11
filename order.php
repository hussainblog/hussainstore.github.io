<?php

include("admin/connection.php");

session_start();

			$userid = $_SESSION['useremail'];

			$username = $_SESSION['name'];
			
			$sel = mysqli_query($conn,"select * from addcart where user='$userid'");

			$sn = 1;
			
            $grandtotal = 1;

            $count = mysqli_num_rows($sel);

            $invoice_no = mt_rand();

			$order_status = "Pending";
			

			while($arr = mysqli_fetch_assoc($sel))
			{
				$productid = $arr['product_id'];

				$quantity = $arr['quantity'];
				

				// Fetch Record from Product Table....
				$sel2 = mysqli_query($conn,"select * from product where pro_id='$productid'");

				$arr2 = mysqli_fetch_assoc($sel2);

				$productname = $arr2['modal_name'];
				
				$totalprice = $arr2['price']*$arr['quantity'];

				$sn++;
				
                //$grandtotal = $grandtotal+$totalprice;
                

                // Insert Data Into Customer Orders.....
                if(mysqli_query($conn,"insert into customer_orders(user,due_amount,invoice_no,total_products,order_status) values('$userid', '$totalprice', '$invoice_no', '$count', '$order_status')"))
                {
					echo "<script> alert('Order Successfully Submitted, Thanks!') 
					location.href='accmanage.php'</script>";

					mysqli_query($conn,"delete from addcart where user='$userid'");

					mysqli_query($conn,"insert into pending_orders(user,invoice_no, product_id, quantity, order_status) values('$userid', '$invoice_no', '$productid', '$quantity', '$order_status')");
                }
                


			}

			$from = 'kushweb.com';
			$subject = 'Order Details';
			$message = "
					<html>

					<p>
					Hello Dear <b style='color:blue;'>$username</b>
					You have ordered some products on our website kushweb.com, please find your order details and pay the dues as soon as possible, so we can proceed your order. Thank You!
					</p>

					   <table width='600' align='center' border='2' bgcolor='#ffcc99'>

					   <tr>
					    <td> <h2> Your Order Details From kushweb.com</h2></td>  
					   </tr>

					   <tr>
						 <th> S.No</th>
						 <th> Product Name</th>
						 <th> Quantity</th>
						 <th> Total Price</th>
						 <th> Invoice</th>
					   </tr>

					   <tr>
						 <td>$sn</td>
						 <td>$productname</td>
						 <td>$quantity</td>
						 <td>$totalprice</td>
						 <td>$invoice_no</td>
					   </tr>

					   </table>

					   <h3> Please go to your account and pay the dues</h3>

					   <h2> <a href='kushweb.com'>Click here</a> to login to your account </h2>

					   <h3> Thank you for order on - www.kushweb.com </h3>
					</html>
					";
					
					mail($userid,$subject,$message,$from);
			?>
