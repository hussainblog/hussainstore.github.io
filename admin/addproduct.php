<?php

if($pageconnect != true)
{
    header("location:index.php");
}

include("connection.php");

extract($_POST);
if(isset($sub))
{
    $mn = trim($mn);
    $pri = trim($pri);
    $quan = trim($quan);
    $dis = trim($dis);
    $pro = trim($pro);
    $ram = trim($ram);
    $os = trim($os);
    $col = trim($col);
    $we = trim($we);
    $disp = trim($disp);
    $wa = trim($wa);
    $batt = trim($batt);
    $desp = trim($desp);
    
    $mn_error = $pri_error = $quan_error = $dis_error = $pro_error = $ram_error = $os_error = $col_error = $we_error = $disp_error = $wa_error = $batt_error = $desp_error =  $frimage_error = $siimage_error = $bkimage_error =  "";

    $mn_valid = $pri_valid = $quan_valid = $dis_valid = $pro_valid = $ram_valid = $os_valid = $col_valid = $we_valid = $disp_valid = $wa_valid = $batt_valid = $desp_valid = $frimage_valid = $siimage_valid = $bkimage_valid = false;

    if(!empty($mn))
    {
        $format = "/^['a-zA-Z0-9 ']+$/";
        if(preg_match($format,$mn))
        {
            $sel = mysqli_query($conn,"select modal_name from product where modal_name = '$mn'");
            $count = mysqli_num_rows($sel);
            if($count == 0)
            {
                $mn_valid = true;
            }
            else
            {
                $mn_error = "Modal Name Already Exists";
            }
        }
        else
        {
            $mn_error = "Modal Name Contains Only Alpahabets And Numeric Values";
        }
    }
    else
    {
        $mn_error = "Modal Name Is Empty";
    }

    
    // Price Validation.....
    if(!empty($pri))
    {
        $format = "/^['0-9']+$/";
        if(preg_match($format,$pri))
        {
            $pri_valid = true;
        }
        else
        {
            $pri_error = "Price Contains Only Numeric Values";
        }
    }
    else
    {
        $pri_error = "Enter Price";
    }


    // Quantity Validation......
    if(!empty($quan))
    {
        $format = "/^['0-9']+$/";
        if(preg_match($format,$quan))
        {
            $quan_valid = true;
        }
        else
        {
           $quan_error = "Quantity Contains Only Numeric Values";
        }
    }
    else
    {
        $quan_error = "Enter Quantity";
    }

    
    // Discount Validation.....
    if(!empty($dis))
    {
       $format = "/^['0-9']+$/";
       if(preg_match($format,$dis))
       {
          $dis_valid = true;
       }
       else
       {
           $dis_error = "Discount Contains Only Numeric Values";
       }
    }
    else
    {
        $dis_error = "Enter Discount";
    }


    // Processor Validation.....
    if(!empty($pro))
    {
        $format = "/^['a-zA-Z0-9. ']+$/";
        if(preg_match($format,$pro))
        {
           $pro_valid = true;
        }
        else
        {
            $pro_error = "Processor Name Contains Only Alpahabets , Numeric & FullStop";
        }
    }
    else
    {
        $pro_error = "Enter Processor Name";
    }


    // Ram Validation.....
    if(!empty($ram))
    {
        $format = "/^['a-zA-Z0-9 ']+$/";
        if(preg_match($format,$ram))
        {
            $ram_valid = true;
        }
        else
        {
            $ram_error = "Ram Contains Only Alphabets & Numeric Values";
        }
    }
    else
    {
        $ram_error = "Enter Ram";
    }


    // Operating System Validation....
    if(!empty($os))
    {
        $format = "/^['a-zA-Z0-9. ']+$/";
        if(preg_match($format,$os))
        {
            $os_valid = true;
        }
        else
        {
            $os_error = "Operating System Contains Only Alphabets & Numeric Values";
        }
    }
    else
    {
        $os_error = "Enter Operating System Name";
    }


    // Color Validation......
    if(!empty($col))
    {
       $format = "/^['a-zA-Z ']+$/";
       if(preg_match($format,$col))
       {
           $col_valid = true;
       }
       else
       {
           $col_error = "Color Contains Only Alphabets";
       }
    }
    else
    {
        $col_error = "Enter Color Name";
    }


    // Weigth Validation....
    if(!empty($we))
    {
       $format = "/^['a-zA-Z0-9. ']+$/";
       if(preg_match($format,$we))
       {
           $we_valid = true;
       }
       else
       {
          $we_error = "Only Alphabets & Numeric Values Allowed";
       }
    }
    else
    {
        $we_error = "Enter Weigth";
    }


    // Display Validation......
    if(!empty($disp))
    {
        $format = "/^['a-zA-Z0-9.+ ']+$/";
        if(preg_match($format,$disp))
        {
            $disp_valid = true;
        }
        else
        {
             $disp_error = "Only Alphabets & Numeric Values Allowed"; 
        }
    }
    else
    {
        $disp_error = "Enter Display Specification";
    }


    // Warranty Validation.....
    if(!empty($wa))
    {
        $format = "/^['a-zA-Z0-9 ']+$/";
        if(preg_match($format,$wa))
        {
            $wa_valid = true;
        }
        else
        {
            $wa_error = "Only Alphabets & Numeric Value Allowed";
        }
    }
    else
    {
        $wa_error = "Enter Warranty Details";
    }


    // Battery Validation...
    if(!empty($batt))
    {
       $format = "/^['a-zA-Z0-9- ']+$/";
       if(preg_match($format,$batt))
       {
           $batt_valid = true;
       }
       else
       {
           $batt_error = "Only Alphabets & Numeric Value Allowed";
       }
    }
    else
    {
        $batt_error = "Enter Battery Details";
    }


    // Description Validation.....
    if(!empty($desp))
    {
        $desp_valid = true;
    }
    else
    {
        $desp_error = "Fill The Description";
    }


    // Front Image Validation......
    $fn1 = $_FILES['fratt']['name'];
    $tmp1 = $_FILES['fratt']['tmp_name'];

    if(!empty($fn1))
    {
       $ext1 = pathinfo($fn1,PATHINFO_EXTENSION);
       $ext1 = strtolower($ext1);

       if($ext1 == 'jpg' || $ext1 == 'jpeg' || $ext1 == 'png' || $ext1 == 'gif')
       {
            $frimage_valid = true;
       }    
       else
       {
           $frimage_error = "Invalid File Type";
       }
    }
    else
    {
        $frimage_error = "Select File";
    }
   
    
    // Side Image Validation.....

    $fn2 = $_FILES['siatt']['name'];
    $tmp2 = $_FILES['siatt']['tmp_name'];

    if(!empty($fn2))
    {
       $ext2 = pathinfo($fn2,PATHINFO_EXTENSION);
       $ext2 = strtolower($ext2);

       if($ext2 == 'jpg' || $ext2 == 'jpeg' || $ext2 == 'png' || $ext2 == 'gif')
       {
            $siimage_valid = true;
       }    
       else
       {
           $siimage_error = "Invalid File Type";
       }
    }
    else
    {
        $siimage_error = "Select File";
    }


    // Back Image Validation.....

    $fn3 = $_FILES['bkatt']['name'];
    $tmp3 = $_FILES['bkatt']['tmp_name'];

    if(!empty($fn3))
    {
       $ext3 = pathinfo($fn3,PATHINFO_EXTENSION);
       $ext3 = strtolower($ext3);

       if($ext3 == 'jpg' || $ext3 == 'jpeg' || $ext3 == 'png' || $ext3 == 'gif')
       {
            $bkimage_valid = true;
       }    
       else
       {
           $bkimage_error = "Invalid File Type";
       }
    }
    else
    {
        $bkimage_error = "Select File";
    }


    // If No Error.....
    if($mn_valid && $pri_valid && $quan_valid && $dis_valid && $pro_valid &&$ram_valid && $os_valid && $col_valid && $we_valid && $disp_valid && $wa_valid && $batt_valid && $desp_valid && $frimage_valid && $siimage_valid && $bkimage_valid == true)
    {
        $fnn1 = uniqid().'.'.$ext1;
        $fnn2 = uniqid().'.'.$ext2;
        $fnn3 = uniqid().'.'.$ext3;

      if(move_uploaded_file($tmp1,"productimages/".$fnn1))
      {
          if(move_uploaded_file($tmp2,"productimages/".$fnn2))
          {
              if(move_uploaded_file($tmp3,"productimages/".$fnn3))
              {
                if(mysqli_query($conn,"insert into product(pro_cat, modal_name, price, quantity, discount, processor, operating_system, ram, display, battery, description, color, weight, warranty, image_front, image_side, image_back) values('$cat','$mn','$pri','$quan','$dis','$pro','$os','$ram','$disp','$batt','$desp','$col', '$we','$wa','$fnn1','$fnn2','$fnn3')"))
                {
                    $_SESSION['success'] = "Product Added Successfully";
                    header("location:Dashboard.php?dash=product");
                    exit;
                }
                else
                {   
                    unlink("productimages/".$fnn1);
                    unlink("productimages/".$fnn2);
                    unlink("productimages/".$fnn3);
                    $error = mysqli_error($conn);
                }
              }
              else
              {
                  $error = "File Uploading Error";
              }
          }
          else
          {
              $error = "File Uploading Error";
          }
      }
      else
      {
          $error = "File Uploading Error";
      }

    }

    
}

?>





<h2 class="text-secondary"> Add Product </h2>


<!------ Eerror --------------------->
<?php
if(isset($error))
{
   ?>
      <lable class="text-danger"> <?php echo $error;?></lable>
   <?php
}
?>



<form method="post" enctype="multipart/form-data">

<div class="form-group">
    <lable> <b> Category </b> </lable>
    <select class="form-control" name="cat" style="font-size:18px;"> 
          <option style="background:lightgrey" value=""  hidden> Select </option>

          <?php
          $sel = mysqli_query($conn,"select * from category");
          while($arr = mysqli_fetch_assoc($sel))
          {
              ?>
              <option value=<?php echo $arr['id']?> > <?php echo $arr['cat_name']?> </option>
        <?php
          }

          ?>
    </select>
</div>

<div class="form-group">
<lable> <b> Modal Name </b> </lable>
<input type="text" name="mn" value="" class="form-control">

<?php
if(isset($mn_error))
{
    ?>
    <lable class="text-danger"> <?php echo $mn_error?></lable>
<?php
}
?>
</div>

<div class="form-group">
<lable> <b> Price </b> </lable>
<input type="text" name="pri" value="" class="form-control">

<?php
if(isset($pri_error))
{
    ?>
    <lable class="text-danger"> <?php echo $pri_error?></lable>
<?php
}
?>

</div>

<div class="form-group">
<lable> <b> Quantity </b> </lable>
<input type="text" name="quan" value="" class="form-control">

<?php
if(isset($quan_error))
{
    ?>
    <lable class="text-danger"> <?php echo $quan_error?></lable>
<?php
}
?>

</div>

<div class="form-group">
<lable> <b> Discount </b> </lable>
<input type="text" name="dis" value="" class="form-control">

<?php
if(isset($dis_error))
{
    ?>
    <lable class="text-danger"> <?php echo $dis_error?></lable>
<?php
}
?>

</div>

<div class="form-group">
<lable> <b> Processor </b> </lable>
<input type="text" name="pro" value="" class="form-control">

<?php
if(isset($pro_error))
{
    ?>
    <lable class="text-danger"> <?php echo $pro_error?></lable>
<?php
}
?>

</div>


<div class="form-group">
<lable> <b> Ram </b> </lable>
<input type="text" name="ram" value="" class="form-control">

<?php
if(isset($ram_error))
{
    ?>
    <lable class="text-danger"> <?php echo $ram_error?></lable>
<?php
}
?>

</div>

<div class="form-group">
<lable> <b> Operating System </b> </lable>
<input type="text" name="os" value="" class="form-control">

<?php
if(isset($os_error))
{
    ?>
    <lable class="text-danger"> <?php echo $os_error?></lable>
<?php
}
?>

</div>

<div class="form-group">
<lable> <b> Color </b> </lable>
<input type="text" name="col" value="" class="form-control">

<?php
if(isset($col_error))
{
    ?>
    <lable class="text-danger"> <?php echo $col_error?></lable>
<?php
}
?>

</div>

<div class="form-group">
<lable> <b> Weight </b> </lable>
<input type="text" name="we" value="" class="form-control">

<?php
if(isset($we_error))
{
    ?>
    <lable class="text-danger"> <?php echo $we_error?></lable>
<?php
}
?>

</div>

<div class="form-group">
<lable> <b> Display </b> </lable>
<input type="text" name="disp" value="" class="form-control">

<?php
if(isset($disp_error))
{
    ?>
    <lable class="text-danger"> <?php echo $disp_error?></lable>
<?php
}
?>

</div>

<div class="form-group">
<lable> <b> Warranty </b> </lable>
<input type="text" name="wa" value="" class="form-control">

<?php
if(isset($wa_error))
{
    ?>
    <lable class="text-danger"> <?php echo $wa_error?></lable>
<?php
}
?>

</div>

<div class="form-group">
<lable> <b> Battery </b> </lable>
<input type="text" name="batt" value="" class="form-control">

<?php
if(isset($batt_error))
{
    ?>
    <lable class="text-danger"> <?php echo $batt_error?></lable>
<?php
}
?>

</div>

<div class="form-group">
<lable> <b> Description </b> </lable>
<input type="text" name="desp" value="" class="form-control">

<?php
if(isset($desp_error))
{
    ?>
    <lable class="text-danger"> <?php echo $desp_error?></lable>
<?php
}
?>

</div>

<div class="form-group">
<lable> <b> Front Image </b> </lable>
<input type="file" name="fratt" multiple class="form-control">

<?php
if(isset($frimage_error))
{
?>
    <lable class="text-danger"> <?php echo $frimage_error;?></lable>
<?php
}
?>
</div>

<div class="form-group">
<lable> <b> Side Image </b> </lable>
<input type="file" name="siatt" multiple class="form-control">

<?php
if(isset($siimage_error))
{
?>
    <lable class="text-danger"> <?php echo $siimage_error;?></lable>
<?php
}
?>
</div>

<div class="form-group">
<lable> <b> Back Image </b> </lable>
<input type="file" name="bkatt" multiple class="form-control">

<?php
if(isset($bkimage_error))
{
?>
    <lable class="text-danger"> <?php echo $bkimage_error;?></lable>
<?php
}
?>
</div>



<div class="form-group">
<input type="submit" name="sub" value="Submit" class="btn btn-success btn-lg">
</div>


</form>
