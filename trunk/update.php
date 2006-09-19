<?php
include('includes/ldap-connect.php');
		if ( isset($_POST['phonenumber']) && isset($_POST['displayname']) && isset($_POST['mobilenumber']))
		{
		$displayname=$info[0]["sn"][0]." ".$info[0]["givenname"][0]." - ".$_POST['displayname'];
		if (empty($_POST['phonenumber']))
			{ $telephonenumber=" "; } else {
			  $telephonenumber=$_POST['phonenumber'];
			  }
		if (empty($_POST['mobilenumber']))
			{ $mobilenumber=" "; } else {
			  $mobilenumber=$_POST['mobilenumber'];
			  }	  
		if (empty($_POST['department']))
			{ $department=" "; } else {
			  $department=$_POST['department'];
			  }	
			  		
		$update["telephonenumber"]=$telephonenumber;
		$update["displayname"]=$displayname;
		$update["mobile"]=$mobilenumber;
		$update["department"]=$department;
		?>
		<table width="600" align="center" border="0" cellpadding="2" cellspacing="0">
		<tr align="center" class="Header-Text">
		<?php
		ldap_modify($ad, $info[0]["dn"], $update);
		?>
			<td colspan="2">Updated!</td></tr>
		<tr class="form" bgcolor="#ffffff"><td><strong>Phone number</strong></td><td><?php echo $telephonenumber; ?></td></tr>
		<tr class="form" bgcolor="#CDDEF2"><td><strong>Mobile number</strong></td><td><?php echo $mobilenumber; ?></td></tr>
		<tr class="form" bgcolor="#ffffff"><td><strong>Display Name</strong></td><td><?php echo $displayname; ?></td></tr>
		<tr class="form" bgcolor="#CDDEF2"><td><strong>Department</strong></td><td><?php echo $department; ?>
		  </td></tr>
		<tr class="form" bgcolor="#ffffff" align="right" ><td colspan="2"><a href="<?php echo $_SERVER['PHP_SELF']; ?>">back</a></td></tr>
</table>
		<?php
		unset($_POST['displayname'], $_POST['mobilenumber'], $_POST['phonenumber']);
		
		} else {
		?>
		<form id="updateuser" name="updateuser" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#userdisplay">
		<table width="600" align="center" border="0" cellpadding="2" cellspacing="0">
		<th colspan="2" class="Header-Text">Active Directory Attributes for : <?php echo $info[0]["givenname"][0]." ".$info[0]["sn"][0]; ?></th>
		<tr class="form" bgcolor="#ffffff"><td><strong>Username</strong></td>
		<td><?php echo $info[0]["samaccountname"][0] ;?></td></tr>
		<tr class="form" bgcolor="#CDDEF2"><td><strong>Logon Domain</strong></td><td><?php echo $domain; ?></td></tr>
		<tr class="form" bgcolor="#ffffff"><td><strong>Telephone Number</strong></td><td>
				<input name="phonenumber" type="text" id="phonenumber" value="<?php if ( isset($_POST['phonenumber'])){echo $_POST['phonenumber']; } else {	if (isset($info[0]["telephonenumber"][0])) { echo $info[0]["telephonenumber"][0] ;} else { echo "";}} ?>" /></td></tr>
		<tr class="form" bgcolor="#CDDEF2"><td><strong>Mobile Number</strong></td><td>
				<input name="mobilenumber" type="text" id="mobilenumber" value="<?php if ( isset($_POST['mobilenumber'])){echo $_POST['mobilenumber']; } else {	if (isset($info[0]["mobile"][0])) { echo $info[0]["mobile"][0] ;} else { echo "";}} ?>" /></td></tr>
		<tr class="form" bgcolor="#FFFFFFF"><td><strong>Department</strong></td><td>
				
        <select name="department" id="department">
          <? foreach ($departmentcontents as $departmentss) {
			   echo "<option value=\"$departmentss\">".$departmentss."</option>";
			} ?>
	    </select>
				
				
				</td></tr>		
		<tr class="form" bgcolor="#CDDEF2"><td><strong>Display Name</strong></td>
		<td>
		<?php
		list($disp1, $disp2) = split(' - ', $info[0]["displayname"][0]);
		echo $disp1." - ";
		?>
		<input name="displayname" type="text" id="displayname" value="<?php if (isset($_POST['displayname'])) { echo $_POST['displayname']; } else {echo $disp2; }?>" size="50" /></td></tr>
		<tr class="form" bgcolor="#ffffff" align="right" >
		  <td colspan="2"><input type="submit" name="Submit" value="Submit" /></form></td>
		</tr>
		</table>
		<?php } 


 ?>

