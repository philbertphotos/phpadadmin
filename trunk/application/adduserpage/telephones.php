
<table width="500" border="0" align="center" cellpadding="5" cellspacing="0" bordercolor="#FBFBFC" bgcolor="#E0DFE3">
  
  <tr>
    <td valign="top"><table width="100%" border="1" align="center" cellpadding="5" cellspacing="0" bgcolor="#F5F5F4">
      <tr>
        <td valign="top" bordercolor="#919B9C"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
          <tr>
            <td width="141">Home:</td>
            <td><?php $item="homephone" ?><input name="<?php echo $item ?>" type="text" id="<?php echo $item ?>" value="<?php if (isset($user[0][$item][0])) { echo $user[0][$item][0]; } ?>" size="50" /></td>
          </tr>
          <tr>
            <td>Pager:</td>
            <td><?php $item="pager" ?><input name="<?php echo $item ?>" type="text" id="<?php echo $item ?>" value="<?php if (isset($user[0][$item][0])) { echo $user[0][$item][0]; } ?>" size="50" /></td>
          </tr>
          <tr>
            <td>Mobile:</td>
            <td><?php $item="mobile" ?><input name="<?php echo $item ?>" type="text" id="<?php echo $item ?>" value="<?php if (isset($user[0][$item][0])) { echo $user[0][$item][0]; } ?>" size="50" /></td>
          </tr>
          <tr>
            <td>Fax:</td>
            <td><?php $item="facsimiletelephonenumber" ?><input name="<?php echo $item ?>" type="text" id="<?php echo $item ?>" value="<?php if (isset($user[0][$item][0])) { echo $user[0][$item][0]; } ?>" size="50" /></td>
          </tr>
          <tr>
            <td>IP phone: </td>
            <td><?php $item="ipphone" ?><input name="<?php echo $item ?>" type="text" id="<?php echo $item ?>" value="<?php if (isset($user[0][$item][0])) { echo $user[0][$item][0]; } ?>" size="50" /></td>
          </tr>
          <tr>
            <td><em>Notes:</em></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"><?php $item="info" ?><textarea name="info" cols="55" rows="5" id="info"><?php if (isset($user[0][$item][0])) { echo $user[0][$item][0]; } ?></textarea></td>
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
<br />
