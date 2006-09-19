<?php 

// Specify only those parameters we're interested in displaying
$attrs = array("memberof","givenname","samaccountname","displayname","mail","telephonenumber","company","givenname","sn");

// Create the filter from the search parameters

$filter = "(samaccountname=".$username.")";

$search = ldap_search($ad, $domaindn, $filter, $attrs)
          or die ("ldap search failed");

$info = ldap_get_entries($ad, $search);

?>
<table>
<tr><td>dn</td><td><?php echo $info[0]["dn"]; ?></td></tr>
<?php for ($i=0; $i<$info[0]["count"]; $i++)
     {
			echo "<tr><td>".$info[0][$i]."</td><td>".$info[0][$info[0][$i]][0]."</td><tr>";
	 }
?>
</table>


