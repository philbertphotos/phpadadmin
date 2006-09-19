<?php
if (!function_exists('ldap_connect')) {
	die ( " LDAP Module does not appear to be installed edit your php.ini" );
	}
include('config.php');
include('departmentlist.php');
$host="ldap://".$hostip ;

list($domain, $username) = split('[\\]', $_SERVER["LOGON_USER"]);

$ad = ldap_connect($host)
      or die( "LDAP Could not connect!" );

// Set version number
ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3)
     or die ("Could not set ldap protocol");

// Binding to ldap server
$bd = ldap_bind($ad, $user, $pswd)
      or die ("Could not bind to LDAP Server");

// Specify only those parameters we're interested in displaying
$attrs = array("department","givenname","samaccountname","displayname","mail","telephonenumber","mobile","company","givenname","sn","memberof");

// Create the filter from the search parameters
list($loginuser, $logindomain) = split('@', $user);

// Work out if $user has is in the group $groupsearch
$filter = "(samaccountname=".$loginuser.")";
$search = ldap_search($ad, $domaindn, $filter, $attrs)
          or die ("ldap search failed");
$info = ldap_get_entries($ad, $search);

array_search("CN=".$ldapreadwrite.",".$ldapreadwriteou.",".$domaindn, $info[0]['memberof'])
  or die ("INSUFFICIENT RIGHTS user $loginuser is not a member of $ldapreadwrite!");
if ($debug==true){
echo "<strong>ldap login ".$loginuser." is member of ".$ldapreadwrite."</strong><br>";
} 
$filter = "(samaccountname=".$username.")";
$search = ldap_search($ad, $domaindn, $filter, $attrs)
          or die ("ldap search failed");

$info = ldap_get_entries($ad, $search);

array_search("CN=".$groupsearch.",".$groupou.",".$domaindn, $info[0]['memberof'])
  or die ("INSUFFICIENT RIGHTS user $username is not a member of $groupsearch!");
if ($debug==true){
echo "<strong>login user ".$username." is a member of ".$groupsearch."</strong><br>";
}
?>