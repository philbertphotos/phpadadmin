<?php include('includes/ldap-connect.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>

<table>
<tr><td>dn</td><td><? echo $info[0]["dn"]; ?></td></tr>
<?

for ($i=0; $i<$info[0]["count"]; $i++)
     {
			echo "<tr><td>".$info[0][$i]."</td><td>".$info[0][$info[0][$i]][0]."</td><tr>";
	 }
?> <tr><td colspan="2"> <?
$groupsearch="Domain Admins";
$groupou="OU=Users and Groups,OU=Service Admin";

 if (array_search("CN=".$groupsearch.",".$groupou.",".$dn, $info[0]['memberof']))
 { echo "Member of Domain Admins";
 } else {
   echo "Not Member of Domain Admin";
 }
?></td></tr></table>
</body>
</html>
