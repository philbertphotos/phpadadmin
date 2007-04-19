<h1>Change My Password</h1>
<?php
if (isset($phpadadmin->ldaps) &&  $phpadadmin->ldaps != true)
	{
	 	exit("Secure LDAP not configured in class, password changes cannot occur.  Please contact you network administrator");
	}
$uid=$phpadadmin->getdbuserid();
$questions=$phpadadmin->getdbuserquestions($uid);	
$rand_keys = array_rand($questions, 2);

?>
<b>Note:</b> Before you change your password exit all your application (except Internet Explorer)
<form name="changepassword" method="post" action="">
<table width="450" align="center">
	
		<tr>
			<td>Question No. 1</td>
			<td><?php 
				$q = rtrim($questions[$rand_keys['0']]['question']);
				echo $q ?>
			</td>
			<td><input type="text" name="answer<?php echo $rand_keys['0'] ?>"></td>
		</tr>
 		<tr>
			<td>Question No. 2</td>
			<td><?php 
				$q = rtrim($questions[$rand_keys['1']]['question']);
				echo $q ?>
			</td>
			<td><input type="text" name="answer<?php echo $rand_keys['1'] ?>"></td>
		</tr> 


	<tr>
		<td colspan="2">
		New Password
		</td>
		<td>
		<input type="password" name="newpwd1">
		</td>
	</tr>
	<tr>
		<td colspan="2">
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
