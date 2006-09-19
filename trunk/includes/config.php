<?php
$hostip = "192.168.165.201:389";  							//  Ipaddress of a domain controller
$user = "administrator@domain.com"; 			// Username to connect to ldap ( should be member of domain admins )
$pswd = "password"; 								// password of user above
$ldapreadwrite = "Domain Admins" ;				    // Group that has read write permission to LDAP	
$ldapreadwriteou = "CN=Users";// OU for group above
$domaindn = "DC=domain,DC=com"; 		// Distinguished name of domain
$groupsearch="Domain Admins"; 						// Group that users have to be a member of to use the web features ( i.e. webaccess )
$groupou="CN=Users";// OU that the above group sits in
$debug=false ;										//display help with ldap connection
$allgroupsou="CN=Users"; // OU where your groups lie
$createusersou="CN=Users";// OU where you want to create users 
$versionnumber="v0.2";
?>