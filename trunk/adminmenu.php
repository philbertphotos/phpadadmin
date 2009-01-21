<div id=adminmenu>
<ul>
<?php if ($username == $_config['ldap']['ad_username'] || $phpadadmin->user_ingroup($username,$_config['phpadadmin']['admingroup'])) { ?>
    <li><a href="<?php echo PATH ?>admin/attributes.php">Attribute Admin</a></li>
    <li><a href="<?php echo PATH ?>admin/config.php?config=ldap">Ldap Config</a></li>
    <li><a href="<?php echo PATH ?>admin/config.php?config=selfservice">Self Service Config</a></li>
    <li><a href="<?php echo PATH ?>admin/config.php?config=phpadadmin">phpADadmin Config</a></li>
<?php  } ?>
    <li class=help><a href="<?php echo PATH ?>">help</a></li>
</ul>
</div>
    
