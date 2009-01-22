<?php
require_once('config.php');

/// CONFIG END
if (empty($_SERVER['LOGON_USER']) && $_SERVER['PHP_SELF'] != PATH.'error.php') 
    { 
        header("Location: http://".$_SERVER['HTTP_HOST'].PATH.'error.php?error=2'); 
        exit(); 
    } 
require_once('functions/loadfunctions.php');
 
$__path = PATH;
$_phpadadmin_version = 'SVN Build!'; 
$_config = _completeconfig();

    
    
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
 
