<h1>My groups</h1>
<?php 

$mygroups=$phpadadmin->adquery2("(samaccountname=".$mynetworkdetails[0]['samaccountname'][0].")",array("memberof"),$userinfo['domain']);
asort($mygroups);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="3">
  <tr>
<?php
$c=0;

for ($i=0; $i<$mygroups[0]['memberof']['count']; $i++)
	{
		$groupname=explode (",",$mygroups[0]['memberof'][$i]);
		$groupname=substr($groupname[0],3);
		$groupinfo=$phpadadmin->adquery2("(distinguishedname=".$mygroups[0]['memberof'][$i].")",array("name"),$userinfo['domain']);
		echo "<tr><td><img src=\"images/icons/view-cdl.gif\" width=\"16\" height=\"12\" /></td><td>".$groupname."</td><td><small>".$mygroups[0]['memberof'][$i]."</small></td></tr>";
		
	}
?>

  </tr>
</table>
