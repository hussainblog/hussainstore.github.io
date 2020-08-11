<?php

include("admin/connection.php");

if(isset($_GET['orderid']))
{
    $orderid = $_GET['orderid'];

}

extract($_POST);
if(isset($sub))
{
     if(mysqli_query($conn,"insert into payment(invoice_no, amount, mode,ref_id, ifsc_code, payment_date) values('$invoice', '$amount', '$payment', '$ref', '$code', '$date')"))
     {
          
         mysqli_query($conn,"update customer_orders set order_status='Completed' where id='$orderid'");

         echo "<h1 style='color:white; text-align:center;'> Payment Received, Order Completed Within 24 Hours </h1>";
     }
}

?>

<html>
     <head>
          <title> Confirm Payment</title>
     </head>

     <body bgcolor="black">

          <form method="post">

               <table width="500" border="1" align="center" bgcolor="#ccccc">
                     
                     <tr align="center">
                     <td colspan="5"> <h1> Please Confirm Your Payment</h1><td>
                     </tr>

                     <tr>
                     <th align="right"> Invoice No:</th>
                     <td> <input type="Text" name="invoice" value=""></td>
                     </tr>

                     <tr>
                     <th align="right"> Amount Paid:</th>
                     <td> <input type="Text" name="amount" value=""></td>
                     </tr>

                     <tr>
                     <th align="right"> Select Payment Mode:</th>
                     <td>
                     <select name="payment">
                     <option hidden> Select Payment</option>
                     <option> Bank Transfer</option>
                     <option> BHIM/UPI</option>
                     <option> Net Banking</option>
                     <option> Debit Card</option>
                     <option> Credit Card</option>
                     </select>
                     </td>
                     </tr>

                     <tr>
                     <th align="right"> Transaction/Refference ID:</th>
                     <td> <input type="Text" name="ref" value=""></td>
                     </tr>

                     <tr>
                     <th align="right"> IFSC Code:</th>
                     <td> <input type="Text" name="code" value=""></td>
                     </tr>

                     <tr>
                     <th align="right"> Payment Date:</th>
                     <td> <input type="Text" name="date" value=""></td>
                     </tr>

                     <tr align="center">
                     <td colspan="6"> <input type="submit" name="sub" value="Confirm Payment"></td>
                     </tr>


               </table>
          </form>
     </body>
</html>