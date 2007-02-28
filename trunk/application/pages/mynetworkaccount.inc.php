<h1>My Network Account</h1>
			  <form id="form1" name="form1" method="post" action="?page=userinfo-update">
			    <table width="100%" border="0" cellspacing="0" cellpadding="2">
<?php foreach ($config['User Edit'] as $key => $value) 
		{
		if ($value['display']=="TRUE"){
		 ?><tr><td width="134" valign="middle"><?php echo $value['name'] ?></td><td>
		<?php 
		
			if ($value['value']=="TRUE")
			  { 
			  if ($value['formfield']=="text"){
			  ?><input name="<?php echo $value['adattrib'] ?>" type="text" id="<?php echo $value['adattrib'] ?>" value="<?php if (!empty($mynetworkdetails[0][$value['adattrib']][0])){echo $mynetworkdetails[0][$value['adattrib']][0];}?>" size="50" /><?php } 
			  if ($value['formfield']=="dropdown"){
			  			$dropdowns=$phpadadmin->csv2array('config/dropdowns/'.$value['adattrib'].'.csv');
						sort($dropdowns);
			  			 ?>
						<select name="<?php echo $value['adattrib'] ?>">
						   <?php 
						   $currentatttr=$value['adattrib'];
						  for ($i=0; $i<count($dropdowns); $i++)
						   {
							if ($dropdowns[$i][0] == $mynetworkdetails[0][$currentatttr][0]) { $selected="selected=\"selected\""; } else { $selected="";}
							?>
							<option value="<?php echo $dropdowns[$i][0]."\"".$selected ?> ><?php echo $dropdowns[$i][0] ?> </option>
							<?php
							}
						  ?>
						</select>				  
			 <?php } ?>
			<?php } else { if (!empty($mynetworkdetails[0]['title'][0])){ echo $mynetworkdetails[0][$value['adattrib']][0];} } ?>
					<input name="was<?php echo $value['adattrib'] ?>" type="hidden" value="<?php if (!empty($mynetworkdetails[0][$value['adattrib']][0])){echo $mynetworkdetails[0][$value['adattrib']][0];}?>" />					</td>
		
		
			<?php } 
				}
			
			?>


				  <tr>
				    <td>User Name: </td>
				    <td><?php echo $userinfo['username'] ?></td>
			      </tr>
				  <tr>
				  	<td></td>
					<td><div align="right">

					  <input type="submit" name="Submit" value="Submit">

				    </div></td>
				  </tr>
                </table>
              </form>