<?php
require_once('../config.php');     
include (INSTALLPATH.'header.php'); 


?>
<div id="mainmenu"> 
    <ul id="tabs"> 
        <li><a href="#<?php echo $_GET['config'] ?>"><?php echo $_GET['config'] ?> Config</a></li>   
    </ul> 
<div>
<div class="bar">&nbsp;</div>
<?php if ($username == $_config['ldap']['ad_username'] | $phpadadmin->user_ingroup($username,$_config['phpadadmin']['admingroup'])) { ?> 
<?php _phpadadmin_config_panel($_GET['config']) ?>
<?php } else { ?>
<p class=accessdenied>Access Denied, you do not have correct permissions to access this page</p>
<?php } ?>
<?php include (INSTALLPATH.'footer.php');?>
