<?php
if (!function_exists('ldap_connect')) {
        header('Location: '.PATH.'install/env-test.php' );    
        }
  require_once('mysql-functions.php');
  require_once('encryption-functions.php');
  require_once('phpadadmin-functions.php');
  require_once(INSTALLPATH.'thirdparty/adLDAP_2.1/adLDAP.php');
  
  $phpadadmin = new adLDAP($_config)  ;
  list($domain, $username) = split('[\\]', $_SERVER["LOGON_USER"]);    
 $getfields = _dbquery('SELECT attr FROM attributes',MYSQL_ASSOC) ;
 foreach ($getfields as $field)
    {
     $fields[]=$field['attr'];   
    }
 $_userinfo = $phpadadmin -> user_info($username,$fields); ?>
