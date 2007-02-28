// phpadadmin.php
// Filename :			readme.txt
// Date :			04/12/2006
// Version :			0.314
// Author :			James Lloyd
// Email :			help@phpadadmin.com
// www :			www.phpadadmin.com


install docs in docs/index.html


Minimum requirements:

* IIS
-* With AD integrated authentication configured

* PHP5
-* With the php_ldap module enabled in your php.ini

V0.3 has 7 functions

adquery:	Perform a basic query throughout AD

adquery (<search field>,<search text>,<fields (in an array)>,<object type>)

i.e.  the below will list all the groups in a domain

	<?php 
	require ('phpadadmin.php');
	$phpadadmin=new phpadadmin;

	echo "<pre>";
	print_r($phpadadmin->adquery("samaccountname","*",array("sn"),"group"));
	echo "</pre>";
	?>

ldaplist:	Perform a basic query on a specific container or OU

ldaplist (<domain dn>,<search field>,<search text>,<field>,<object>)

example:
examples/oulist.php dynamically lists the ou's / containers in the AD and shows the user / groups that exist within them.

updateaccount(<Job Title>,<Telephone Number>,<Mobile Number>,<Fax Number>,<Department>,<Company Name>,<dn of user>)

i.e. the below script will update the account James Lloyd

	<?php 
	require ('phpadadmin.php');
	$phpadadmin=new phpadadmin;

	$phpadadmin->updateaccount("IT Manager","05555555","05555555","0555555","IT Department","Some Company","CN=James Lloyd,OU=IT Users,CN=domain,CN=COM");

	?>

getuser():	Get the username and domain of the user currently accessing

i.e. the script below will echo the username and domain of the user


	<?php 
	require ('phpadadmin.php');
	$phpadadmin=new phpadadmin;

	$userinfo=$phpadadmin->getuser();
	echo $userinfo['username'];
	echo "<br>";
	echo $userinfo['domain'];

	?>
	
ingroup:	Return true if user in in a group


i.e. the script below will test if the current user is in domain admins

	<?php 
	require ('phpadadmin.php');
	$phpadadmin=new phpadadmin;

	$userinfo=$phpadadmin->getuser();

	$group = "CN=Domain Admins,OU=Users and Groups,DC=domain,DC=com";
	$domainadmins=$phpadadmin->ingroup($userinfo['username'],$group);
	echo "<br>";

	if ($domainadmins == true) 
		{ 
		echo $userinfo['username']." is a member of ".$group; 
		} else {
		echo $userinfo['username']." is not a member of ".$group;
		}


	?>

creategroup:	Create a group

	Script below creates a group called "test22222group" in the ou testcreation.
	note: will check to make sure the name is available

	<?php 
	require ('phpadadmin.php');
	$phpadadmin=new phpadadmin;

	$phpadadmin->creategroup("test22222group","OU=testcreation");
	
	?>

createuser:	Create a user ( disabled )

	Script Below creates a user called "lastname - firstname"
	
	<?php 
	require ('phpadadmin.php');
	$phpadadmin=new phpadadmin;
	
	$phpadadmin->createuser("lastname","firstname","firstname - lastname","jamesjamesjames","OU=testcreation","yes");
	
	?>