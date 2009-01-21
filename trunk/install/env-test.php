<html>
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
 <?php if ($_SERVER['SERVER_NAME'] == 'localhost') { ?>
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
 </fieldset>
 <fieldset><legend>Mysql</legend>
 <div class="test <?php if (!function_exists('mysql_connect')) { $test='Fail'; ?>fail<?php } ?>">
           php mysql module =  <?php if (function_exists('mysql_connect')) {?>Success<?php } else { ?>Fail!
          <?php  $errorcount++; ?>   
           <?php } ?>
 </div>  

<?php if (!isset($errorcount)) { ?>
     <a href="../admin/config.php?config=ldap">Configure Ldap Settings</a>
<?php } ?>
   
<?php } else {?>
  <div class="test fail">
           This page can only be views from the server its installed on!
 </div>
<?php } ?>
     
</div>
</body>
</html>