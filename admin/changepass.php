<?php

include("connection.php");

if($pageconnect != true)
{
    header("location:index.php");
}

?>

<script>

$(document).ready(function()
{
    $('#sub').click(function()
    {
         olp = $('#olp').val();
         np = $('#np').val();
         cp = $('#cp').val();

         //alert(olp+np+cp);

         olperror = nperror = cperror = "";
         olp_valid = np_valid = cp_valid = false;

         // Old Password Validation......
         if(olp.trim() !="")
         {
            olp_valid = true;
         }
         else
         {
             olperror = "Enter Old Password";
         }


         // New Password Validation....

         if(np.trim() !="")
         {
            if(np.length >= 4 && np.length <= 10)
            {
                np_valid = true;
            }
            else
            {
                nperror = "New Password Must Be Between 4 To 10 Characters";
            }
         }
         else
         {
             nperror = "Enter New Password";
         }
         

         // Confirm Password.....

         if(cp.trim() !="")
         {
            if(cp.length >= 4 && cp.length <= 10)
            {
                if(np == cp)
                {
                    cp_valid = true;
                }
                else
                {
                    cperror = "New Password And Confirm Password Doesn't Match";
                }
            }
            else
            {
                cperror = "Confirm Password Must Be Between 4 To 10 Characters";
            }
         }
         else
         {
              cperror = "Enter Confirm Password";
         }


         // If No Error.....
         if(olp_valid && np_valid && cp_valid == true)
         {
             $.ajax({
                 url     : 'passapi.php',
                 method  : 'get',
                 data    :  {oldpass:olp, newpass:np},
                 success : function(data)
                 {
                     $('#message').html(data);
                 },
                 error  : function()
                 {
                     alert('not working');
                 }
             })
         }
         else
         {
             $('#olderror').html(olperror);
             $('#newerror').html(nperror);
             $('#confirmerror').html(cperror);
         }

    })
})

</script>

<h2 class="text-info"> Change Password</h2>

<lable id="message" class="text-success"></lable>

<div class="form-group">
<lable class="text-info"> <b>Old Password </b></lable>
<input type="password" name="olp" id="olp" class="form-control">
<lable id="olderror" class="text-danger"></lable>
</div>

<div class="form-group">
<lable class="text-info"> <strong>New Password </strong></lable>
<input type="password" name="np" id="np" class="form-control">
<lable id="newerror" class="text-danger"></lable>
</div>

<div class="form-group">
<lable class="text-info"> <strong>Confirm Password </strong></lable>
<input type="password" name="cp" id="cp" class="form-control">
<lable id="confirmerror" class="text-danger"></lable>
</div>

<div>
<input type="submit" name="sub" id="sub" value="submit" class="btn btn-success btn-lg">
</div>