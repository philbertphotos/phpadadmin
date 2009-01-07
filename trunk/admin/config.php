<?php
require_once('../config.php');    
$sql='SELECT * FROM '.$db_database.'.config;';   
include (INSTALLPATH.'header.php'); 
?>
<div id="mainmenu"> 
    <ul id="tabs"> 
        <li><a href="#ldap">LDAP Config</a></li>  
        <li><a href="#selfservice">Self Service Config</a></li>  
        <li><a href="#phpadadmin">phpADadmin Config</a></li>  
    </ul> 
<div>
<div class="bar">&nbsp;</div>
<?php
function _phpadadmin_config_panel($sql,$name)
    { ?>
    <div class="panel" id="<?php echo $name ?>">
    <fieldset><legend><?php echo $name ?> config</legend> 
    <form name="<?php echo $name ?>" action="" method="post">
    <?php $configs = _dbquery($sql,MYSQL_ASSOC) ?>
    <?php foreach($configs as $config) { ?>
     <div class="form-row">
      <div class="field-label"><label for="<?php echo $config['name'] ?>"><?php echo $config['name'] ?></label>:</div> 
      <div class="field-widget"><input class="required <?php if (isset($config['validation'])) { echo $config['validation'] ; } ?>" id="<?php echo $config['name'] ?>"  type="text" name="<?php echo $config['name'] ?>" value="<?php echo $config['value'] ?>"> <em><?php echo $config['example'] ?></em></div>
     </div> 
    <?php } ?> 
    <div class="field-widget"><input name="<?php echo $name ?>config-submit" type="submit" value="Update" /></div>
    </fieldset> 
    </div>
     <script type="text/javascript"> 
        function formCallback(result, form) { window.status = "valiation callback for form '" + form.id + "': result = " + result; }
        var valid = new Validation('<?php echo $name ?>', {immediate : true, onFormValidate : formCallback});
    </script> 
<?php } ?>

<?php _phpadadmin_config_panel('SELECT * FROM '.$db_database.'.config WHERE type=\'domain\';','ldap') ?>
<?php _phpadadmin_config_panel('SELECT * FROM '.$db_database.'.config WHERE type=\'password\';','selfservice') ?>
<?php _phpadadmin_config_panel('SELECT * FROM '.$db_database.'.config WHERE type=\'phpadadmin\';','phpadadmin') ?>

<?php include (INSTALLPATH.'footer.php');?>
