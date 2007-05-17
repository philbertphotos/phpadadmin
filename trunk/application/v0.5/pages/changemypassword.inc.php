<h1>Self Service Password Reset</h1>
<?php
if (isset($phpadadmin->ldaps) &&  $phpadadmin->ldaps != true)
	{
	 	exit("Secure LDAP not configured in class, password changes cannot occur.  Please contact you network administrator");
	}
if (!isset($_POST['finduser']) && $_SERVER[REQUEST_METHOD] == "GET")
	{
	?>
	<form name="finduser" method="post" action="">
	<table width="450" align="center">
			<tr><td>Username</td><td><input type="text" name="username"></td></tr>
			<tr><td>First Name</td><td><input type="text" name="givenname"> <small>note: case sensitive</small></td></tr>
			<tr><td>Last Name</td><td><input type="text" name="sn"> <small>note: case sensitive</small></td></tr>
			<tr><td>Domain</td><td><select name="domain">
			<?php 
			foreach ($phpadadmin->domainconfig as $key => $value) 
				{
				echo "<option value='".$key."'>".$key."</option>";
				}
			?>
			</td></tr>
			<tr><td colspan="3" align="right"><input type="submit" name="finduser" value="Find User"></td></tr>	
<?php
	}
if (isset($_POST['finduser']) && $_POST['finduser'] == "Find User")
	{
	
	
	$fields=array("givenname","sn");
	$finduser=$phpadadmin->adquery("samaccountname",$_POST['username'],$fields,"user",$_POST['domain']) ;

	if ($finduser['count'] > 0)
		{
		echo "<br><b>User Found</b><br>";
		if ($finduser['0']['sn']['0'] == $_POST['sn'] && $finduser['0']['givenname']['0'] == $_POST['givenname'])
			{
			echo "names match";
			echo $finduser[0]['dn'];
			$continue=true;
			} else {
			echo "name are wrong";
			
			}
			echo "<br>";
		} else {
		echo "no user found";
		}
	
	if ($continue==true)
		{
		$uid=$phpadadmin->getdbuserid($_POST['username'],$_POST['domain']);
		$questions=$phpadadmin->getdbuserquestions($uid);	
		$numberofq=$phpadadmin->questionstoask;
		$rand_keys = array_rand($questions, $numberofq);

		?>
		<form name="changepassword" method="post" action="">
		<table width="450" align="center">
			<?php
			for ($i=0; $i<$numberofq ; $i++)
				{
				?><tr>
					<td>Question No.<?php echo $i+1 ?></td>
					<td><?php $q = rtrim($questions[$rand_keys[$i]]['question']); ?>
					<input type="text" name="question<?php echo $i ?>" value="<?php echo $q ?>" readonly>
					</td>		
				<td><input type="password" name="answer<?php echo $i ?>"></td><?php
				
				
				}
			?></tr>

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
				<input type="hidden" name="domain" value="<?php echo $_POST['domain'] ?>">
				<input type="hidden" name="dn" value="<?php echo $finduser[0]['dn'] ?>">
				<input type="hidden" name="username" value="<?php echo $_POST['username'] ?>">
				<input type="submit" name="changepassword" value="Change Password">
				</td>
			</tr>
		</table>
		<?php

		}
	}
if (isset($_POST['changepassword']) && $_POST['changepassword'] == "Change Password"  && $_SERVER[REQUEST_METHOD] == "POST")
{
	if ($_POST['newpwd1'] != $_POST['newpwd2'])
		{
			exit("Passwords do not Match");
		} 
	if (strlen($_POST['newpwd1']) < $phpadmin->minpwdlength)
		{
			exit("Password too short!");
		}

	$userdn=$_POST['dn'];
	$uid=$phpadadmin->getdbuserid($_POST['username'],$_POST['domain']);
	echo $phpadadmin->questionstoask;
	for ($i=0; $i<$phpadadmin->questionstoask; $i++)
		{
		$answer=$phpadadmin->checkdbquestion($uid,$_POST['question'.$i],rtrim($_POST['answer'.$i]));
		if ($answer == "WRONG")
			{
				exit("wrong".$_POST['question'.$i]);
			} else {

			}
		}




$phpadadmin->changepassword($userdn,$_POST['newpwd1'],$_POST['domain']);
$phpadadmin->resetlockedaccount($userdn,$_POST['domain']);
}
	?>
