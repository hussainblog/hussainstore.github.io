<?php 

if($pageconnect != true)
{
    header("location:index.php");
}

$editid = $_GET['eid'];
//echo $editid;

$sel = mysqli_query($conn,"select category.cat_name, product.* from category inner join product on category.id = product.pro_cat where pro_id='$editid'");

$arr = mysqli_fetch_assoc($sel);


// Update Product.....
extract($_POST);
if(isset($sub))
{
    $fn1 = $_FILES['fratt']['name'];
    $tmp1 = $_FILES['fratt']['tmp_name'];

    $fn2 = $_FILES['siatt']['name'];
    $tmp2 = $_FILES['siatt']['tmp_name'];

    $fn3 = $_FILES['bkatt']['name'];
    $tmp3 = $_FILES['bkatt']['tmp_name'];

    if(empty($fn1))
    {
        if(mysqli_query($conn,"update product set pro_cat='$cat', modal_name='$mn', price='$pri', quantity='$quan', discount='$dis', processor='$pro', ram='$ram', operating_system='$os', color='$col', weight='$we', display='$disp', warranty='$wa', battery='$batt', description='$desp' where pro_id='$editid'"))
        {
            $_SESSION['success'] = "Product Updated Successfully";
            header("location:Dashboard.php?dash=product");
            exit;
        }
        else
        {
            $error = mysqli_error($conn);
        }
    }
    else
    {
         if(move_uploaded_file($tmp1,"productimages/".$fn1))
         {
             if(move_uploaded_file($tmp2,"productimages/".$fn2))
             {
                 if(move_uploaded_file($tmp3,"productimages/".$fn3))
                 {
                    if(mysqli_query($conn,"update product set pro_cat='$cat', modal_name='$mn', price='$pri', quantity='$quan', discount='$dis', processor='$pro', ram='$ram', operating_system='$os', color='$col', weight='$we', display='$disp', warranty='$wa', battery='$batt', description='$desp', image_front='$fn1', image_side='$fn2', image_back='$fn3' where pro_id='$editid'"))
                    {
                       $_SESSION['success'] = "Product Updated Successfully";
                       header("location:dashboard.php?dash=product");
                       exit;
                    }
                    else
                    {
                        unlink("productimages/".$fn1);
                        unlink("productimages/".$fn2);
                        unlink("productimages/".$fn3);

                        $_SESSION['error'] = mysqli_error($conn);
                    }
                 }
                 else
                 {
                     $_SESSION['error'] = "File Uploading Error";
                 }
             }
             else
             {
                 $_SESSION['error'] = "File Uploading Error";
             }
         }
         else
         {
             $_SESSION['error'] = "File Uploading Error";
         }
    }

    

    


}

?>

<h2 class="text-secondary"> Update Product </h2>

<form method="post" enctype = "multipart/form-data">

<div class="form-group">
    <lable> <b> Category </b> </lable>
    <select class="form-control" name="cat" style="font-size:18px;"> 
          <option style="background:lightgrey" value="<?php echo $arr['pro_cat']?>"  hidden> <?php echo $arr['cat_name']?> </option>

        
<!--Select Category From Category Table to Product Table In A Dropdown-->

          <?php
          $sel = mysqli_query($conn,"select * from category");
          while($arr2 = mysqli_fetch_assoc($sel))
          {
              ?>
              <option value="<?php echo $arr2['id']?>" > <?php echo $arr2['cat_name']?> </option>
        <?php
          }

          ?>
    </select>
</div>


<div class="form-group">
<lable> <b> Modal Name </b> </lable>
<input type="text" name="mn" value="<?php echo $arr['modal_name']?>" class="form-control">

</div>

<div class="form-group">
<lable> <b> Price </b> </lable>
<input type="text" name="pri" value="<?php echo $arr['price']?>" class="form-control">
</div>

<div class="form-group">
<lable> <b> Quantity </b> </lable>
<input type="text" name="quan" value="<?php echo $arr['quantity']?>" class="form-control">
</div>

<div class="form-group">
<lable> <b> Discount </b> </lable>
<input type="text" name="dis" value="<?php echo $arr['discount']?>" class="form-control">
</div>

<div class="form-group">
<lable> <b> Processor </b> </lable>
<input type="text" name="pro" value="<?php echo $arr['processor']?>" class="form-control">
</div>


<div class="form-group">
<lable> <b> Ram </b> </lable>
<input type="text" name="ram" value="<?php echo $arr['ram']?>" class="form-control">
</div>

<div class="form-group">
<lable> <b> Operating System </b> </lable>
<input type="text" name="os" value="<?php echo $arr['operating_system']?>" class="form-control">
</div>

<div class="form-group">
<lable> <b> Color </b> </lable>
<input type="text" name="col" value="<?php echo $arr['color']?>" class="form-control">
</div>

<div class="form-group">
<lable> <b> Weight </b> </lable>
<input type="text" name="we" value="<?php echo $arr['weight']?>" class="form-control">
</div>

<div class="form-group">
<lable> <b> Display </b> </lable>
<input type="text" name="disp" value="<?php echo $arr['display']?>" class="form-control">
</div>

<div class="form-group">
<lable> <b> Warranty </b> </lable>
<input type="text" name="wa" value="<?php echo $arr['warranty']?>" class="form-control">
</div>

<div class="form-group">
<lable> <b> Battery </b> </lable>
<input type="text" name="batt" value="<?php echo $arr['battery']?>" class="form-control">
</div>

<div class="form-group">
<lable> <b> Description </b> </lable>
<input type="text" name="desp" value="<?php echo $arr['description']?>" class="form-control">

</div>

<div class="form-group">
<lable> <b> Front Image </b> </lable>
<input type="file" name="fratt" multiple class="form-control">
<img src="productimages/<?php echo $arr['image_front']?>" height="80" width="80">

</div>

<div class="form-group">
<lable> <b> Side Image </b> </lable>
<input type="file" name="siatt" multiple class="form-control">
<img src="productimages/<?php echo $arr['image_side']?>" height="80" width="80">

</div>

<div class="form-group">
<lable> <b> Back Image </b> </lable>
<input type="file" name="bkatt" multiple class="form-control">
<img src="productimages/<?php echo $arr['image_back']?>" height="80" width="80">

</div>

<div class="form-group">
<input type="submit" name="sub" value="Update" class="btn btn-success btn-lg">
</div>

</form>