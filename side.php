<div class="content-sidebar">
		    		<h4 style="font-weight:bold;">Categories</h4>
						<ul>

						<?php

						$sel = mysqli_query($conn,"select * from category");
						while($arr = mysqli_fetch_assoc($sel))
						{
							?>

                            <li><a href="category.php?cid=<?php echo $arr['id']?>&&cname=<?php echo $arr['cat_name']?>"> <?php echo $arr['cat_name']?></a></li>
						<?php
						}
						?>
							
						</ul>
		    	</div>