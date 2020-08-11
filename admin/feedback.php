<?php
if($pageconnect != true)
{
    header("location:dashboard.php");
}
?>

<h2 class="text-warning"> Feedback </h2>

<table class="table">

     <tr>

     <th> S.No</th>
     <th> Name</th>
     <th> Email</th>
     <th> Mobile No.</th>
     <th> Subject</th>
     <th> Date</th>

     </tr>

     <?php 
     
     $sn = 1;
     $sel = mysqli_query($conn,"select * from feedback");
     while($arr = mysqli_fetch_assoc($sel))
     {
         ?>

         <tr>

         <td> <?php echo $sn;?></td>
         <td> <?php echo $arr['name']?></td>
         <td> <?php echo $arr['email']?></td>
         <td> <?php echo $arr['mobile']?></td>
         <td> <?php echo $arr['subject']?></td>
         <td> <?php echo $arr['date']?></td>

         </tr>
    <?php
    $sn++;
     }
     
     ?>

</table>