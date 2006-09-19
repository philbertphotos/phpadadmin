<?php
include ('ldap-connect.php');
$allousattrs = array("objectclass","ou");
$allousfilter = "(objectclass=organizationalunit)";
$alloussearch = ldap_search($ad, $dn, $allousfilter, $allousattrs)
          or die ("ldap search failed");
		 
$allous = ldap_get_entries($ad, $alloussearch);



 for ($i=0; $i<$allous["count"]; $i++)
     {
			echo $allous[$i]['ou'][0]."<br>";
	 }

?>