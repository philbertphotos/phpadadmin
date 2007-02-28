
<table width="500" border="0" align="center" cellpadding="5" cellspacing="0" bordercolor="#FBFBFC" bgcolor="#E0DFE3">
  
  <tr>
    <td valign="top"><table width="100%" border="1" align="center" cellpadding="5" cellspacing="0" bgcolor="#F5F5F4">
      <tr>
        <td bordercolor="#919B9C"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
          <tr>
            <td width="141" valign="top">Street:</td>
            <td><?php $item="streetaddress" ?><textarea name="<?php echo $item ?>" cols="37" rows="5" id="<?php echo $item ?>"><?php if (isset($user[0][$item][0])) { echo $user[0][$item][0]; } ?></textarea></td>
            </tr>
          <tr>
            <td>P.O. Box: </td>
            <td><?php $item="postofficebox" ?><input name="<?php echo $item ?>" type="text" id="<?php echo $item ?>" value="<?php if (isset($user[0][$item][0])) { echo $user[0][$item][0]; } ?>" size="50" /></td>
          </tr>
          <tr>
            <td>City</td>
            <td><?php $item="l" ?><input name="<?php echo $item ?>" type="text" id="<?php echo $item ?>" value="<?php if (isset($user[0][$item][0])) { echo $user[0][$item][0]; } ?>" size="50" /></td>
          </tr>
          <tr>
            <td>State/province:</td>
            <td><?php $item="st" ?><input name="<?php echo $item ?>" type="text" id="<?php echo $item ?>" value="<?php if (isset($user[0][$item][0])) { echo $user[0][$item][0]; } ?>" size="50" /></td>
          </tr>
          <tr>
            <td>Zip/Postal Code: </td>
            <td><?php $item="postalcode" ?><input name="<?php echo $item ?>" type="text" id="<?php echo $item ?>" value="<?php if (isset($user[0][$item][0])) { echo $user[0][$item][0]; } ?>" size="50" /></td>
          </tr>
          <tr>
            <td>Country/region:</td>
            <td><select  name="select">
			<?php
 				$countries=$phpadadmin->csv2array('adduserpage/countries.csv');		 
			  	for ($i=0; $i<count($countries); $i++)
					{
					if ($user[0]['countrycode'][0] == $countries[$i][3]) { $selected="selected=\"selected\"" ;} else { $selected="" ;}
					echo "<option value=\"".$countries[$i][3]."\"".$selected.">".$countries[$i][0]."</option>\n";
					}
			?>	 
            </select>
            </td>
          </tr>
        </table>          </td>
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

