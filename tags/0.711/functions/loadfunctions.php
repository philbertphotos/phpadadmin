<?php
if (!function_exists('ldap_connect') | !function_exists('mcrypt_get_iv_size') | !function_exists('mysql_connect')) {
        header('Location: '.PATH.'install/env-test.php' );    
        }
  require_once('mysql-functions.php');
  require_once('encryption-functions.php');
  require_once('phpadadmin-functions.php');
  require_once(INSTALLPATH.'thirdparty/adLDAP_2.1/adLDAP-phpadadmin.php');
?>
