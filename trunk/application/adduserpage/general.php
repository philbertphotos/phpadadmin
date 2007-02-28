
<table width="500" border="0" align="center" cellpadding="5" cellspacing="0" bordercolor="#FBFBFC" bgcolor="#E0DFE3">
  
  <tr>
    <td><table width="100%" border="1" align="center" cellpadding="5" cellspacing="0" bgcolor="#F5F5F4">
      <tr>
        <td bordercolor="#919B9C"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
          <tr>
            <td width="141">First name: </td>
            <td width="167"><?php $item="givenname" ?><input name="<?php echo $item ?>" type="text" id="<?php echo $item ?>" value="<?php if (isset($user[0][$item][0])) { echo $user[0][$item][0]; } ?>" /></td>
            <td width="56">Initials:</td>
            <td width="88"><?php $item="initials" ?><input name="<?php echo $item ?>" type="text" id="<?php echo $item ?>" value="<?php if (isset($user[0][$item][0])) { echo $user[0][$item][0]; } ?>" size="10" /></td>
          </tr>
          <tr>
            <td>Last name: </td>
            <td colspan="3"><?php $item="sn" ?><input name="<?php echo $item ?>" type="text" id="<?php echo $item ?>" value="<?php if (isset($user[0][$item][0])) { echo $user[0][$item][0]; } ?>" size="50" /></td>
          </tr>
          <tr>
            <td>Display Name: </td>
            <td colspan="3"><?php $item="displayname" ?><input name="<?php echo $item ?>" type="text" id="<?php echo $item ?>" value="<?php if (isset($user[0][$item][0])) { echo $user[0][$item][0]; } ?>" size="50" /></td>
          </tr>
          <tr>
            <td>Description:</td>
            <td colspan="3"><?php $item="discription" ?><input name="<?php echo $item ?>" type="text" id="<?php echo $item ?>" value="<?php if (isset($user[0][$item][0])) { echo $user[0][$item][0]; } ?>" size="50" /></td>
          </tr>
          <tr>
            <td>Office:</td>
            <td colspan="3"><?php $item="office" ?><input name="<?php echo $item ?>" type="text" id="<?php echo $item ?>" value="<?php if (isset($user[0][$item][0])) { echo $user[0][$item][0]; } ?>" size="50" /></td>
          </tr>
        </table>
              <hr />
              <table width="100%" border="0" cellspacing="0" cellpadding="3">
                <tr>
                  <td width="141">Telephone number:</td>
                  <td width="69%"><?php $item="telephonenumber" ?><input name="<?php echo $item ?>" type="text" id="<?php echo $item ?>" value="<?php if (isset($user[0][$item][0])) { echo $user[0][$item][0]; } ?>" size="50" /></td>
                </tr>
                <tr>
                  <td>E-mail:</td>
                  <td><?php $item="mail" ?><input name="<?php echo $item ?>" type="text" id="<?php echo $item ?>" value="<?php if (isset($user[0][$item][0])) { echo $user[0][$item][0]; } ?>" size="50" /></td>
                </tr>
                <tr>
                  <td>Web page: 
                  <input name="dn" type="hidden" id="dn" value="<?php if (isset($user[0][$item])) { echo $user[0][$item]; } ?>"/></td>
                  <td><?php $item="wwwhomepage" ?><input name="<?php echo $item ?>" type="text" id="<?php echo $item ?>" value="<?php if (isset($user[0][$item][0])) { echo $user[0][$item][0]; } ?>" size="50" /></td>
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

