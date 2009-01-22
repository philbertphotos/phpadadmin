<?php require_once('../env.php'); ?>
<?php include (INSTALLPATH.'header.php'); ?>
<?php if (!isset($_GET['config'])) { $_GET['config'] = 'ldap'; } ?>
<div id="mainmenu"> 
    <ul id="tabs"> 
        <li><a href="#<?php echo $_GET['config'] ?>"><?php echo $_GET['config'] ?> Config</a></li>   
    </ul> 
<div>
<div class="bar">&nbsp;</div>
 <?php if ($_SERVER['SERVER_NAME'] == 'localhost') { ?>
<?php _phpadadmin_config_panel($_GET['config']) ?>
<?php } else {?>
    This page is only available from the server
<?php } ?>
<?php include (INSTALLPATH.'templates/footer.php');?>
