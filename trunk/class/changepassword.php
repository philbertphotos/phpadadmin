<?php
include('phpadadmin0.4.php');
$phpadadmin=new phpadadmin;
$userinfo=$phpadadmin->getuser();
$userrequested=$phpadadmin->adquery("samaccountname",$userinfo['username'],array("distinguishedName"),"user",$userinfo['domain']);
?>
<html>
<head>
<title>Change password Proof of Concept</title>
</head>
<body>
<form name="changepassword" method="post" action="">
<table width="450" align="center">
	<tr>
		<td>
		Username
		</td>
		<td>
		<input <?php if (isset($_GET['any']) && $_GET['any'] == "true") { echo "";} else { echo "readonly=\"readonly\"";} ?> type="text" name="username" value="<?php echo $userinfo['username'] ?>">@<?php echo $phpadadmin->domainconfig[$userinfo['domain']]['fqdn'] ?>
		</td>
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
if (isset($phpadadmin->ldaps) &&  $phpadadmin->ldaps != true)
	{
	 	exit("Secure LDAP not configured in class<br>password changes cannot occur ");
	}

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
	
	$userdn=$userrequested[0]['distinguishedname'][0];

	$phpadadmin->changepassword($userdn,$_POST['newpwd1'],$userinfo['domain']);
	
	}
?>
<p>
Note: In order for the password change function to work, <a href="http://www.phpadadmin.com">php-AD-admin</a> must be able to connect to LDAP (Active Directory) using LDAPS (secure LDAP). This is enabled on your domain controller if you have a Root Certificate Authority installed on your domain. 
</p>
<p>
Also to allow PHP to connect to LDAPS (php uses the openldap client) you will need to create the file ldap.conf on the server where a href="http://www.phpadadmin.com">php-AD-admin</a> sits.  The file should be in <b>c:\openldap\sysconf</b> and contain one line.
</p>
<code>TLSREQCERT never</code>
<br><br>
<center>built with <a href="http://www.phpadadmin.com">php-AD-admin</a> by James Lloyd</center>

</body>
</html>