<?php

include("connection.php");

if($pageconnect != true)
{
    header("location:index.php");
}



// Delete Product......

if(isset($_GET['did']) && isset($_GET['dimg1']) && isset($_GET['dimg2']) && isset($_GET['dimg3']))
{
   $did   = $_GET['did'];
   $dimg1 = $_GET['dimg1'];
   $dimg2 = $_GET['dimg2'];
   $dimg3 = $_GET['dimg3'];

   //echo $did,$dimg1,$dimg2,$dimg3;

   if(mysqli_query($conn,"delete from product where pro_id = '$did'"))
   {
       unlink("productimages/".$dimg1);
       unlink("productimages/".$dimg2);
       unlink("productimages/".$dimg3);

      $_SESSION['success'] = "Product Deleted Successfully";
   }
   else
   {
      $error = mysqli_connect_error($conn);
   }
}

?>

<h2 class="text-secondary"> Product </h2>


<!---------- Success Message Of Adding Product------------>
<?php

if(isset($_SESSION['success']))
{
    ?>
       <lable class="alert-success"> <?php echo $_SESSION['success'];?></lable>
    <?php
    unset($_SESSION['success']);
}
?>


<!-------------- Error Message Of Deleting Product------------->
<?php 
if(isset($error))
{
   ?>
   <lable class="text-danger"> <?php echo $error ?></lable>
<?php
}
?>



<!---------- Error Message Of Editing Product-------------->
<?php

if(isset($_SESSION['error']))
{
   ?>
   <lable class="text-danger"> <?php echo $_SESSION['error']?> </lable>
<?php 
unset($_SESSION['error']);
}

?>


<table align="center" class="table">
    
    <tr>
       <th colspan="8" class="text-center"> <a href="dashboard.php?dash=addpro" class="btn btn-secondary"> Add Product </a> </th>
    </tr>

      <tr>
      <th> S.No</th>
      <th> Category Name</th>
      <th> Modal Name</th>
      <th> Image</th>
      <th> Price</th>
      <th> Quantity</th>
      <th> Discount</th>
      <th> Action</th>
      </tr>

      <?php
      
      $sn = 1;
      $sel = mysqli_query($conn,"select category.cat_name, product.* from category inner JOIN product on category.id = product.pro_cat;
      ");
      while($arr = mysqli_fetch_assoc($sel))
      {
         ?>

         <tr>
            <td style="vertical-align:middle;"> <?php echo $sn;?></td>
            <td style="vertical-align:middle;"> <?php echo $arr['cat_name']?></td>
            <td style="vertical-align:middle;"> <?php echo $arr['modal_name']?></td>
            <td style="vertical-align:middle;"> <img src="productimages/<?php echo $arr['image_front']?>" height="50" width="50"></td>
            <td style="vertical-align:middle;"> Rs <?php echo $arr['price']?></td>
            <td style="vertical-align:middle;"> <?php echo $arr['quantity']?> Pcs </td>
            <td style="vertical-align:middle;"> <?php echo $arr['discount']?>%</td>
            <td style="vertical-align:middle;"> <a href="dashboard.php?dash=editpro&&eid=<?php echo $arr['pro_id']?>" class="btn btn-outline-success"> Edit </a>
            <a href="dashboard.php?dash=product&&did=<?php echo $arr['pro_id']?>&&dimg1=<?php echo $arr['image_front']?> && dimg2=<?php echo $arr['image_side']?> && dimg3=<?php echo $arr['image_back']?>" class="btn btn-outline-danger"> Delete </a>
            </td>
         </tr>

      <?php
      $sn++;
      }
      
      ?>
</table>