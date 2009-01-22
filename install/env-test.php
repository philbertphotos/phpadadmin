<?php include ('../config.php') ?><html>
<head>
<title>phpADadmin Environment Setup debug</title>
<meta name="author" content="James Lloyd">
<link rel="stylesheet" type="text/css" href="../style.css" />
<style>
.test { 
    padding:3px;
    margin:10px;
    background: #80FF80;   
}
.fail {
    background: #FF8080;
}

</style>
</head>
<body>                              
<div id="wrapper">
<div id="header">
<img src="../images/logo.gif">
</div>
<div id=content>
<h4>Env Test</h4>
 <?php if ($_SERVER['SERVER_NAME'] == 'localhost') { ?>
 <fieldset><legend>IIS</legend>
 <?php list($domain, $username) = split('[\\]', $_SERVER["LOGON_USER"]);  ?>
 <div class="test <?php if (empty($domain) || empty($username)) { $test='Fail'; ?>fail<?php } ?>">
           Seamless authentication =  <?php if (!empty($domain) || !empty($username)) {?>Success<?php } else { ?>Fail!
          <?php  $errorcount++; ?>   
           <?php } ?>
 </div>
 </fieldset> 
 <fieldset><legend>PHP</legend> 
 <div class="test <?php if (!function_exists('mcrypt_get_iv_size')) { $test='Fail'; ?>fail<?php }  ?>">
           php mycrypt module =  <?php if (function_exists('mcrypt_get_iv_size')) {?>Success<?php } else { ?>Fail!
           <?php  $errorcount++; ?>
           <?php } ?>
 </div>
 <div class="test <?php if (!function_exists('ldap_connect')) { $test='Fail'; ?>fail<?php } ?>">
           php ldap module =  <?php if (function_exists('ldap_connect')) {?>Success<?php } else { ?>Fail!
           <?php  $errorcount++; ?>   
           <?php } ?>
 
 </div>
  <div class="test <?php if (!function_exists('mysql_connect')) { $test='Fail'; ?>fail<?php } ?>">
           php mysql module =  <?php if (function_exists('mysql_connect')) {?>Success<?php $mysql='true'; } else { ?>Fail!
          <?php  $errorcount++; ?>   
           <?php } ?>
 </div>
 </fieldset>
  <?php if ($mysql == 'true') { ?> 
 <fieldset><legend>Mysql</legend>
 <?php if (mysql_connect($db_host,$db_user,$db_pass)) { $mysql_connect ='true'; mysql_close(); } else { $mysql_connect = 'fail'; } ?>
 <div class="test <?php if ($mysql_connect == 'fail') { $test='Fail'; ?>fail<?php } ?>">
           Connect to your DB using:
           <ul>
              <li>host = <?php echo $db_host ?></li>
              <li>database name = <?php echo $db_database ?></li>
              <li>user = <?php echo $db_user ?></li>
              <li>password = *******</li>
           </ul>
             <?php if ($mysql_connect == 'true') {?>Success<?php } else { ?>Fail!
          <?php  $errorcount++; ?>   
           <?php } ?>

 </div>  
<?php } ?>
 </fieldset> 
<?php
 if ($mysql_connect =='true') { 
require_once('../functions/loadfunctions.php'); 
$_config = _completeconfig();
 $phpadadmin = new adLDAP($_config['ldap'])  ;
 $adtest = $phpadadmin -> user_info($username); 

?>
 <fieldset><legend>Active Directory Connect</legend> 
 <?php if ($adtest) { ?>
 <div class="test <?php if (!$adtest) { $test='Fail'; ?>fail<?php } ?>">
 Connection with AD = <?php if ($adtest) {?>Success<?php $mysql='true'; } else { ?>Fail!
          <?php  $errorcount++; ?>   
           <?php } ?>
 <pre><?php print_r($adtest) ?></pre><?php } ?>
 </div>
 </fieldset>

 
  <fieldset><legend>LDAPS (Secure LDAP)</legend>
  <p>
 <div class="test <?php if (!file_exists('C:/openldap/sysconf/ldap.conf')) { $test='Fail'; ?>fail<?php } ?>">
 <p>this is only required is you want to use LDAPS (self service password resets) </p>
           Open Ldap file =  <?php if (file_exists('C:/openldap/sysconf/ldap.conf')) {?>Success<?php } else { ?>Fail!
          <?php  $errorcount++; ?>   
           <?php } ?>
 </div>   
 </fieldset>
<?php } ?> 
<?php if (!isset($errorcount)) { ?>
     <a href="password.php">Set Your AD Password</a>

<?php } ?>
   
<?php } else {?>
  <div class="test fail">
           This page can only be views from the server its installed on!
 </div>
<?php } ?>
     
</div>
</body>
</html>