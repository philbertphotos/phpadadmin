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
<?php include ('adminmenu.php'); ?><img src="<?php echo PATH ?>images/logo.gif">
</div>
<?php include ('menu.php'); ?>
<div id=content>
<h4><?php echo $_userinfo[0]['givenname'][0] ?> <?php echo $_userinfo[0]['sn'][0] ?></h4>
