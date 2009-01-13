<?php
list($domain, $username) = split('[\\]', $_SERVER["LOGON_USER"]);   
  
   $phpadadmin = new adLDAP($_config['ldap'])  ;
 
 $getfields = _dbquery('SELECT attr FROM attributes',MYSQL_ASSOC) ;
 foreach ($getfields as $field)
    {
     $fields[]=$field['attr'];
    }
    $fields[]='samaccountname';   
    $fields[]='dn'; 
 $_userinfo = $phpadadmin -> user_info($username,$fields); 
?>
<html>
<head>
<title>phpadadmin</title>
<meta name="author" content="James Lloyd">
<link rel="shortcut icon"  href="">
        <script src="<?php echo PATH ?>thirdparty/prototype.js" type="text/javascript"></script> 
        <script src="<?php echo PATH ?>thirdparty/scriptaculous.js" type="text/javascript"></script> 
        <script src="<?php echo PATH ?>thirdparty/validate.js" type="text/javascript"></script>
        <script src="<?php echo PATH ?>thirdparty/fabtabulous.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo PATH ?>style.css" />
</head>
<body>
<div id="wrapper">
<div id="header">
<img src="<?php echo PATH ?>images/logo.gif"><?php include ('adminmenu.php'); ?>
</div>
<div class=clear></div>
<?php include ('menu.php'); ?>
<div id=content>
<?php if (isset($_userinfo)) { ?>
    <h4><?php echo $_userinfo[0]['givenname'][0] ?> <?php echo $_userinfo[0]['sn'][0] ?> - (<?php echo $username; ?>) </h4>
<?php } ?>
