<?php
define("INSTALLPATH", "D:/wamp/www/phpadadmin/");    // logical install path where its installed      e.g. c:/dir or /home/user/www
define("PATH", "/phpadadmin/");    // www path where its installed
$db_user = "root"; // Username
$db_pass = ""; // Password
$db_database = "phpadadmin"; // Database Name
$db_host = "localhost"; // Server Hostname   
  
//Setup Smarty
define("SMARTYPATH", INSTALLPATH."thirdparty/smarty/libs/");   
require(SMARTYPATH.'Smarty.class.php');
$smarty = new Smarty();
$smarty->template_dir = INSTALLPATH.'smarty/templates';
$smarty->compile_dir = INSTALLPATH.'smarty/templates_c';
$smarty->cache_dir = INSTALLPATH.'smarty/cache';
$smarty->config_dir = INSTALLPATH.'smarty/configs';

//load my functions
require_once('functions/loadfunctions.php');
?>
