<?php
define("INSTALLPATH", "c:/inetpub/wwwroot/phpadadmin/");    // logical install path where its installed      e.g. c:/dir or /home/user/www
define("PATH", "/phpadadmin/");    // www path where its installed
$db_user = "root"; // mysql Username
$db_pass = "password"; // mysql Password
$db_database = "phpadadmin"; // mysql Database Name
$db_host = "localhost"; // mysql Server Hostname and port if you arnt using the default
$administatoruser = "Administrator";  // Account that is allowed to access the config page

/// CONFIG END
if (empty($_SERVER['LOGON_USER']) && $_SERVER['PHP_SELF'] != PATH.'error.php') 
    { 
        header("Location: http://".$_SERVER['HTTP_HOST'].PATH.'error.php?error=2'); 
        exit(); 
    } 

require_once('functions/loadfunctions.php');

$_phpadadmin_version = 'SVN Build!'; 
$completeconfig = _dbquery('SELECT `name`,`value`,`type` FROM '.$db_database.'.config ;',MYSQL_ASSOC);  
       foreach ($completeconfig as $configitem)
        {
         if ($configitem['name'] == 'domain_controllers')
            {
             $value = explode (',',$configitem['value'])   ;
            } else {
            $value =  $configitem['value'];  
            }
         $_config[$configitem['type']][$configitem['name']]= $value;
        }

    
    
list($domain, $username) = split('[\\]', $_SERVER["LOGON_USER"]); 
  if (class_exists('adLDAP')) {  
   $phpadadmin = new adLDAP($_config['ldap'])  ;

         $getfields = _dbquery('SELECT attr FROM attributes',MYSQL_ASSOC) ;
         foreach ($getfields as $field)
            {
             $fields[]=$field['attr'];
            }
            $fields[]='samaccountname';   
            $fields[]='dn'; 
         $_userinfo = $phpadadmin -> user_info($username,$fields);
         }
if ($_config['phpadadmin']['forcehttps'] == 'TRUE') { if ($_SERVER["SERVER_PORT"]!=443){ header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']); exit(); } } 
?>
 
