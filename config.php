<?php
define("INSTALLPATH", "c:/inetpub/wwwroot/phpadadmin/");    // logical install path where its installed      e.g. c:/dir or /home/user/www
define("PATH", "/phpadadmin/");    // www path where its installed
$db_user = "root"; // Username
$db_pass = "password"; // Password
$db_database = "phpadadmin"; // Database Name
$db_host = "localhost"; // Server Hostname   
$administatoruser = "Administrator";  // Account that is allowed to access the config page
require_once('functions/loadfunctions.php');
if ($_config['phpadadmin']['forcehttps'] == 'TRUE') 
    { if ($_SERVER["SERVER_PORT"]!=443){ header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']); exit(); } }


?>