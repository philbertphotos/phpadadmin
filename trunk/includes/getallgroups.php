<?php
$allgroupsou = $allgroupsou.",".$domaindn;
$allgroupattrs = array("cn","objectclass");
$allgroupfilter = "(objectclass=group)";
$allgroupsearch = ldap_search($ad, $allgroupsou, $allgroupfilter, $allgroupattrs)
          or die ("ldap search failed");
	 
$allgroups = ldap_get_entries($ad, $allgroupsearch);
?>