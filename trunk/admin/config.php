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
<?php _phpadadmin_config_panel($_GET['config']) ?>
<?php include (INSTALLPATH.'footer.php');?>
