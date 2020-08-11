<?php

include("admin/connection.php");

session_start();

if(isset($_GET['productid']) && isset($_GET['proquantity']))
{
    $productid = $_GET['productid'];
    $proquantity = $_GET['proquantity'];

    if(isset($_SESSION['useremail']))
    {
        $userid = $_SESSION['useremail'];
    }
    else
    {
        $userid = session_id();
    }

    
    $sel = mysqli_query($conn,"select * from addcart where product_id='$productid' and quantity='$proquantity'");

    $count = mysqli_num_rows($sel);
    if($count == 0)
    {
        if(mysqli_query($conn,"insert into addcart(user,product_id,quantity) values('$userid','$productid','$proquantity')"))
        {
            echo "Cart Added Successfully";
        }
    }
    else
    {
        if(mysqli_query($conn,"update addcart set quantity = quantity+'$proquantity' where product_id='$productid' and quantity='$proquantity'"))
        {
            echo "Cart Added Successfully";
        }
    }
}

?>