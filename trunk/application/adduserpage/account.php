
<table width="500" border="0" align="center" cellpadding="5" cellspacing="0" bordercolor="#FBFBFC" bgcolor="#E0DFE3">
  
  <tr>
    <td><table width="100%" border="1" align="center" cellpadding="5" cellspacing="0" bgcolor="#F5F5F4">
      <tr>
        <td valign="top" bordercolor="#919B9C"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
          <tr>
            <td colspan="4">User logon name: </td>
            </tr>
          <tr>
            <td width="225"><?php $item="userprincipalname" ?><input name="<?php echo $item ?>" type="text" id="<?php echo $item ?>" value="<?php if (isset($user[0][$item][0])) { echo $user[0][$item][0]; } ?>" size="35" /></td>
            <td width="239" colspan="3">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4">User logon name (pre-Windows 2000): </td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td colspan="3"><?php $item="samaccountname" ?><input name="<?php echo $item ?>" type="text" id="<?php echo $item ?>" value="<?php if (isset($user[0][$item][0])) { echo $user[0][$item][0]; } ?>" size="35" /></td>
          </tr>
          <tr>
            <td>Cant do the rest of these functions yet </td>
            <td colspan="3">&nbsp;</td>
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

