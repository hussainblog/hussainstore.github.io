<?php

include("admin/connection.php");

if(isset($_GET['cid']))
{
    $cartid = $_GET['cid'];
}

if(mysqli_query($conn,"delete from addcart where id = '$cartid'"))
{
    header("location:cartdetails.php");
}
else
{
    echo mysqli_error($conn);
}

?>