<h1>Change My Password</h1>
<?php
if (isset($phpadadmin->ldaps) &&  $phpadadmin->ldaps != true)
	{
	 	exit("Secure LDAP not configured in class, password changes cannot occur.  Please contact you network administrator");
	}
?>
<b>Note:</b> Before you change your password exit all your application (except Internet Explorer)
<form name="changepassword" method="post" action="">
<table width="450" align="center">
	<tr>
		<td>
		Username
		</td>
		<td>
		<?php echo $userinfo['username'] ?>@<?php echo $phpadadmin->domainconfig[$userinfo['domain']]['fqdn'] ?>
		</td><input type="hidden" name="username" value="<?php echo $userinfo['username'] ?>">
	</tr>
	<tr>
		<td>
		Old Password
		</td>
		<td>
		<input type="password" name="currentpwd">
		</td>
	</tr>
	<tr>
		<td>
		New Password
		</td>
		<td>
		<input type="password" name="newpwd1">
		</td>
	</tr>
	<tr>
		<td>
		Confirm New Password
		</td>
		<td>
		<input type="password" name="newpwd2">
		</td>
	</tr>	
	<tr>
		<td colspan="2">
		<input type="submit" name="submit" value="Change Password">
		</td>
	</tr>
</table>
<?php
if (isset($_POST['submit']))
	{
	if (!empty($_POST['username']) && !empty($_POST['currentpwd']))
		{
			// Connect to AD using specified password to check Auth
			$ldap = ldap_connect('ldaps://'.$phpadadmin->domainconfig[$userinfo['domain']]['fqdn'],636); 
			ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3); 
			ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
			ldap_bind($ldap, $_POST['username']."@".$phpadadmin->domainconfig[$userinfo['domain']]['fqdn'], $_POST['currentpwd']); 
			if (ldap_errno($ldap) !== 0) 
			{ 
			    exit('Password incorrect!'); 
			} 
		} else {
			exit("Username & Password not set");
		}
		
	if ($_POST['newpwd1'] != $_POST['newpwd2'])
		{
			exit("Passwords do not Match");
		} 
	if (strlen($_POST['newpwd1']) < $phpadmin->minpwdlength)
		{
			exit("Password too short!");
		}
	
	$userdn=$mynetworkdetails[0]['dn'];

	$phpadadmin->changepassword($userdn,$_POST['newpwd1'],$userinfo['domain']);
	
	}
?>
