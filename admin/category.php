<?php

if($pageconnect != true)
{
    header("location:index.php");
}

?>

<script>
$(document).ready(function()
{
  $('.editbtn').click(function()
  {
      catid = $(this).attr('catid');
      catname = $(this).attr('catname');
      catimg = $(this).attr('catimg');

      //alert(catid+catname+catimg);

      $('#hid').val(catid);
      $('#himg').val(catimg);
      $('#edcat').val(catname);
  })
})

</script>

<style>
th,td{vertical-align:middle;}
table,th,td,tr{text-align:center;}
</style>


<?php

extract($_POST);
if(isset($sub))
{
   $cat = trim($cat);

   $cat_error = $img_error = "";
   $cat_valid = $img_valid = false;

   if(!empty($cat))
   {
      $format = "/^['a-zA-Z']+$/";
      if(preg_match($format,$cat))
      {
         $sel = mysqli_query($conn,"select cat_name from category where cat_name='$cat'");
         if(mysqli_num_rows($sel)==0)
         {
            $cat_valid = true;
         }
         else
         {
           $cat_error = "Category Name Alreay Exists";
         }
      }
      else
      {
        $cat_error = "Category Name Contains Only Alphabets";
      }
   }
   else
   {
     $cat_error = "Enter Category Name";
   }
   
   
   // Image Validdation....
   $fn = $_FILES['att']['name'];
   $tmp = $_FILES['att']['tmp_name'];

   if(!empty($fn))
   {
      $ext = pathinfo($fn,PATHINFO_EXTENSION);
      $ext = strtolower($ext);
      
      if($ext=='jpg' || $ext=='jpeg' || $ext=='png' || $ext=='gif')
      {
         $img_valid = true;
      }
      else
      {
        $img_error = "Invalid File Type";
      }
   }
   else
   {
     $img_error = "Select File";
   }

     if($cat_valid && $img_valid == true)
     {
        $fnn = uniqid().'.'.$fn;
        if(move_uploaded_file($tmp,"catimages/".$fnn))
        {
           if(mysqli_query($conn,"insert into category(cat_name,image)values('$cat','$fnn')"))
           {
              $_SESSION['message'] = "Category Uploaded Successfully";
              header("location:dashboard.php?dash=category");
              exit;
           }
           else
           {
              unlink("catimages/".$fnn);
              $error = mysqli_error($conn);
           }
        }
        else
        {
          $error = "File Uploading Error";
        }
     }
     
}


// Delete Category.....
if(isset($_GET['cid']) && isset($_GET['cimg']))
{
   $catid =  $_GET['cid'];
   $catimg = $_GET['cimg'];

   if(mysqli_query($conn,"delete from category where id='$catid'"))
   {
       unlink("catimages/".$catimg);
       $message = "Category Deleted Successfully";
       header("location:dashboard.php?dash=category&&mess=$message");

   }
   else
   {
       $error = mysqli_error($conn);
   }
}


// Edit Category........
extract($_POST);
if(isset($edsub))
{
   $edcat = trim($edcat);

   $edcat_error = $edimg_error = "";
   $edcat_valid = false;

   if(!empty($edcat))
   {
      $format = "/^['a-zA-Z']+$/";
      if(preg_match($format,$edcat))
      {
         $sel = mysqli_query($conn,"select cat_name from category where cat_name='$edcat' and id !='$hid'");
         $count = mysqli_num_rows($sel);
         if($count==0)
         {
            $edcat_valid = true;
         }
         else
         {
           $edcat_error = "Category Name Already Exists";
         }
         
      }
      else
      {
        $edcat_error = "Only Alphabets Allowed";
      }
   }
   else
   {
     $edcat_error = "Category Name is Empty";
   }

    
   // Update Category......
   $fn = $_FILES['edatt']['name'];
   $tmp = $_FILES['edatt']['tmp_name'];
   $oldimg = $arr['image'];

   if(empty($fn))
   {
      if($edcat_valid==true)
      {
        if(mysqli_query($conn,"update category set cat_name='$edcat' where id = '$hid'"))
        {
           $_SESSION['message'] = "Category Updated Successfully";
           header("location:dashboard.php?dash=category");
           exit;
        }
        else
        {
          $error = mysqli_error($conn);
        }
      }
   }
   else
   {
       $edimg_valid = false;
       $ext = pathinfo($fn,PATHINFO_EXTENSION);
       $ext = strtolower($ext);

       if($ext=='jpg' || $ext=='jpeg' || $ext=='png' || $ext=='gif')
       {
          $edimg_valid = true;
       }
       else
       {
         $edimg_error = "Invalid File Type";
       }

       if($edcat_valid && $edimg_valid == true)
       {
         $fnn = uniqid().'.'.$fn;
          if(move_uploaded_file($tmp,"catimages/".$fnn))
          {
             if(mysqli_query($conn,"update category set cat_name='$edcat', image='$fnn' where id='$hid'"))
             {
                $_SESSION['message'] = "Category Updated Successfully";
                header("location:dashboard.php?dash=category");
                exit;
             }
             else
             {
               unlink("catimages/".$fnn);
                $error = mysqli_error($conn);
             }
          }
          else
          {
            $edimg_error = "File Updating Error";
          }
       }
   }
}



?>

<h2 class="text-success">Category</h2>

<!------------- Error Message --------------->
<?php
if(!empty($error))
{
  ?>
  <lable class="alert-danger"> <?php echo $error; ?></lable>
<?php
}
?>

<!------------ Successfully Message Of Delete Category -------------->
<?php
if(!empty($_GET['mess']))
{
  ?>
  <lable class="alert-success"> <?php echo $_GET['mess']?></lable>
<?php
}
?>


<!------ Successfully Message Of Add Category -------------->
<?php
if(!empty($_SESSION['message']))
{
  ?>
  <lable class="alert-success"> <?php echo $_SESSION['message'] ?> </lable>
<?php
unset($_SESSION['message']);
}
?>

<table class="table">

<tr>
<th colspan="6" class="text-center"> <a href="javascript:void()" class="btn btn-success" data-toggle="modal" data-target="#addcategory"> Add Category </a> </th>
</tr>

<tr>
<td> <b> S.No </b> </td>
<td> <b>Category Name </b></td>
<td> <b> Image </b> </td>
<td> <b> Date </b> </td>
<td> <b> Action </b> </td>
</tr>

<?php 
$sn=1;
$sel = mysqli_query($conn,"select * from category");
while($arr = mysqli_fetch_assoc($sel))
{
  ?>

  <tr>
  <td> <?php echo $sn;?></td>
  <td> <?php echo $arr['cat_name'];?></td>
  <td> <img src="catimages/<?php echo $arr['image']?>" height="50" width="50"></td>
  <td> <?php echo $arr['date']?></td>
  <td> <a href="javascript:void()" class="btn btn-outline-success editbtn" data-toggle="modal" data-target="#editcategory" catid="<?php echo $arr['id']?>" catname="<?php echo $arr['cat_name']?>" catimg="<?php echo $arr['image']?>">Edit </a>  
  <a href="dashboard.php?dash=category&&cid=<?php echo $arr['id']?> && cimg=<?php echo $arr['image']?>" class="btn btn-outline-danger"> Delete </a></td>
  </tr>

<?php 
$sn++; 
}
?>
</table>

<!-- The Modal -->
  <div class="modal fade" id="addcategory">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"> Add Category</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          
          <form method="post" enctype="multipart/form-data">

          <div class="form-group">
          <lable class="text-success"> Category </lable>
          <input type="text" name="cat" value="" placeholder="Enter Category Name" class="form-control">
          <?php 
          if(!empty($cat_error))
          {
            ?>
            <lable class="text-danger"> <?php echo $cat_error?> </lable>
          <?php
          }
          ?>
          </div>

          <div class="form-group">
          <lable class="text-success"> Image </lable>
          <input type="file" name="att" value="" class="form-control">

          <?php 
          if(!empty($img_error))
          {
            ?>
            <lable class="text-danger"> <?php echo $img_error?> </lable>
          <?php
          }
          ?>

          </div>

          <div>
          <input type="submit" name="sub" value="Submit" class="btn btn-success">
          </div>


          </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
    
    </div>
  </div>
  
</div>




<!-- The Modal -->
<div class="modal fade" id="editcategory">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"> Edit Category</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          
          <form method="post" enctype="multipart/form-data">

          <input type="text" id="hid" name="hid">
          <input type="text" id="himg">

          <div class="form-group">
          <lable class="text-success"> Category </lable>
          <input type="text" name="edcat" id ="edcat" value="" placeholder="Enter Category Name" class="form-control">

          <?php
          if(isset($edcat_error))
          {
            ?>
            <lable class="text-danger"> <?php echo $edcat_error; ?></lable>
          <?php
          }
          ?>
         </div>

          <div class="form-group">
          <lable class="text-success"> Image </lable>
          <input type="file" name="edatt" id="edatt" value="" class="form-control">
          
          <?php
          if(isset($edimg_error))
          {
            ?>
            <lable class="text-danger"> <?php echo $edimg_error; ?></lable>
          <?php
          }
          ?>
        
          </div>

          <div>
          <input type="submit" name="edsub" value="Submit" class="btn btn-success">
          </div>


          </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
    
    </div>
  </div>
  
</div>
