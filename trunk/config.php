<?php
define("INSTALLPATH", "D:/wamp/www/phpadadmin/");    // logical install path where its installed      e.g. c:/dir or /home/user/www
define("PATH", "/phpadadmin/");    // www path where its installed
$db_user = "root"; // Username
$db_pass = ""; // Password
$db_database = "phpadadmin"; // Database Name
$db_host = "localhost"; // Server Hostname   

require_once('functions/loadfunctions.php');


if (!isset($_SERVER['HTTPS']) && $_config['forcehttps'] == 'TRUE') 
    { header('Location: https://'.$_SERVER['REMOTE_HOST'].$_SERVER['REQUEST_URI']); } else { $https = 'false'; }
 ?>

