<?php
if (!function_exists('ldap_connect')) {
        header('Location: '.PATH.'install/env-test.php' );    
        }
  require_once('mysql-functions.php');
  require_once('encryption-functions.php');
  
?>
