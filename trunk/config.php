<?php
define("INSTALLPATH", "c:/inetpub/wwwroot/");    // logical install path where its installed      e.g. c:/dir or /home/user/www
define("PATH", "/");    // www path where its installed
$db_user = "root"; // Username
$db_pass = "password"; // Password
$db_database = "phpadadmin"; // Database Name
$db_host = "localhost"; // Server Hostname   

require_once('functions/loadfunctions.php');
<<<<<<< .mine
if ($_config['phpadadmin']['forcehttps'] == 'TRUE') 
    { if ($_SERVER["SERVER_PORT"]!=443){ header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']); exit(); } }


?>
=======


if (!isset($_SERVER['HTTPS']) && $_config['forcehttps'] == 'TRUE') 
    { header('Location: https://'.$_SERVER['REMOTE_HOST'].$_SERVER['REQUEST_URI']); } else { $https = 'false'; }
    list($domain, $username) = split('[\\]', $_SERVER["LOGON_USER"]);
 ?>

>>>>>>> .r97
