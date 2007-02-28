<?php
if (isset($_GET['user']) && isset($_GET['domain']))
 {
 $user=$phpadadmin->adquery2("(samaccountname=".$_GET['user'].")",array("givenname","initials","sn","displayname","description","office","telephonenumber","mail","wwwhomepage","select","dn","streetaddress","postofficebox","l","st","postalcode","userprincipalname","samaccountname","profilepath","scriptpath","homedirectory","homedrive","homephone","pager","mobile","facsimileTelephoneNumber","ipphone","textarea","title","department","company","manager","directreports","countrycode","info"),$_GET['domain']);
 }

?>
