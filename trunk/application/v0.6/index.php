<?php
include('includes/class.php');
$phpadadmin=new phpadadmin;
$currentuser=$phpadadmin->auth_getuser($dbconnect);
$phpadadmin->misc_array2table($currentuser);
?>