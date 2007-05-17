
<table width="500" border="0" align="center" cellpadding="5" cellspacing="0" bordercolor="#FBFBFC" bgcolor="#E0DFE3">
  
  <tr>
    <td><table width="100%" border="1" align="center" cellpadding="5" cellspacing="0" bgcolor="#F5F5F4">
      <tr>
        <td valign="top" bordercolor="#919B9C"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
          <tr>
            <td><em>User Profile</em></td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td width="141">Profile path: </td>
            <td colspan="2"><?php $item="profilepath" ?><input name="<?php echo $item ?>" type="text" id="<?php echo $item ?>" value="<?php if (isset($user[0][$item][0])) { echo $user[0][$item][0]; } ?>" size="50" /></td>
            </tr>
          <tr>
            <td>Logon script: </td>
            <td colspan="2"><?php $item="scriptpath" ?><input name="<?php echo $item ?>" type="text" id="<?php echo $item ?>" value="<?php if (isset($user[0][$item][0])) { echo $user[0][$item][0]; } ?>" size="50" /></td>
          </tr>
          <tr>
            <td colspan="3"><hr /></td>
            </tr>
          <tr>
            <td><em>Home Folder</em></td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td>
                Local Path: </td>
            <td colspan="2"><?php $item="homedirectory" ?><input name="<?php echo $item ?>" type="text" id="<?php echo $item ?>" value="<?php if (isset($user[0][$item][0])) { echo $user[0][$item][0]; } ?>" size="50" /></td>
          </tr>
          <tr>
            <td>              Connect:</td>
            <td><select name="homedrive" id="homedrive">
						<?php
 				$driveletters=$phpadadmin->csv2array('adduserpage/driveletters.csv');		 
			  	for ($i=0; $i<count($driveletters); $i++)
					{
					if ($user[0]['homedrive'][0] == $driveletters[$i][0]) { $selected="selected=\"selected\"" ;} else { $selected="" ;}
					echo "<option value=\"".$driveletters[$i][1]."\" ".$selected.">".$driveletters[$i][0]."</option>\n";
					}
			?>
			</select>
            </td>
            <td>To:
              <?php $item="homedirectory" ?><input name="<?php echo $item ?>" type="text" id="<?php echo $item ?>" value="<?php if (isset($user[0][$item][0])) { echo $user[0][$item][0]; } ?>" size="30" /></td>
          </tr>
        </table>
          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><div align="right">
      <input  size="10" type="submit" name="Submit" value="OK" />
      <input type="reset" name="Submit2" value="Cancel" />
    </div></td>
  </tr>
</table>

