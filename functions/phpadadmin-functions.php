<?php
function _completeconfig()
    {
     global $db_database;
     $completeconfig = _dbquery('SELECT `name`,`value`,`type` FROM '.$db_database.'.config ;',MYSQL_ASSOC);  
       foreach ($completeconfig as $configitem)
        {
         if ($configitem['name'] == 'domain_controllers')
            {
             $value = explode (',',$configitem['value'])   ;
            } else {
            $value =  $configitem['value'];  
            }
         $_config[$configitem['type']][$configitem['name']]= $value;
        }
      return  $_config;          
    }
function _html_pagetitle() 
    {
     echo 'phpadadmin';   
    }
function _html_java()
    {
     global $__path;
    echo '<script src="'.PATH.'thirdparty/prototype.js" type="text/javascript"></script>';  
    echo '<script src="'.PATH.'thirdparty/validate.js" type="text/javascript"></script>';
    echo '<script src="'.PATH.'thirdparty/fabtabulous.js" type="text/javascript"></script>'; 
    echo '<script src="'.PATH.'thirdparty/scriptaculous.js" type="text/javascript"></script>';     
    }
function _html_css()
    {
      echo '<link rel="stylesheet" type="text/css" href="'.PATH.'style.css" />';   
    }
function _get_attributes($config=false)
    {
       global $_config;
       global $db_database;
       if ($_config['ldap']['exchangeinstalled'] == 'TRUE') 
            {
            if ($config = false) { $where = ''; } else { $where = 'WHERE uservisable = \'TRUE\''; } 
            //if ($forsearch = false) { $where = ''; } else { $where = $where.' search = \'TRUE\' AND'; } 
            $sql='SELECT * FROM '.$db_database.'.attributes '.$where.' ORDER BY `order`;'; 
            } else {
            if ($config = false) { $where = ''; } else { $where = 'uservisable = \'TRUE\' AND'; }
            //if ($forsearch = false) { $where = ''; } else { $where = $where.' search = \'TRUE\' AND'; }     
            $sql='SELECT * FROM '.$db_database.'.attributes WHERE '.$where.' requireexchange = \'FALSE\' ORDER BY `order`;';    
            }
        $attrs = _dbquery($sql,MYSQL_ASSOC)    ;
        return ($attrs);    
    }

function _phpadadmin_config_panel($name)
    { 
     global $db_database; 
     global $_get;  
        ?>
    <div class="panel" id="<?php echo $name ?>">
    <fieldset><legend><?php echo $name ?> config</legend> 
    <form name="<?php echo $name ?>" action="updateconfig.php" method="post">
    <?php $configs = _dbquery('SELECT * FROM '.$db_database.'.config WHERE type=\''.$name.'\';',MYSQL_ASSOC) ?>
    <?php foreach($configs as $config) { ?>
     <div class="form-row">
      <div class="field-label"><label for="<?php echo $config['name'] ?>"><?php echo $config['name'] ?></label>:</div> 
      <div class="field-widget">
        <input size="45" 
        <?php if ($name == 'ldap' && $config['name'] == 'ad_password') { ?> DISABLED <?php } ?>
        class="required <?php if (isset($config['validation'])) { echo $config['validation'] ; } ?>" 
        id="<?php echo $config['name'] ?>"  
        type="<?php if ($config['name'] == 'ad_password') { ?>password<?php } else { ?>text<?php } ?>" 
        name="<?php echo $config['name'] ?>" 
        value="<?php if ($name == 'ldap' && $config['name'] == 'ad_password') { ?>Im not stupid enough to put the password in clear text in the html thankyou.<?php } else { echo $config['value'];  }?>"> <em><?php echo $config['example'] ?></em></div>
     </div>
     <input type="hidden" name="<?php echo $config['name'] ?>-id" value="<?php echo $config['id'] ?>">    
    <?php } ?> 
    <div class="field-widget"><input name="<?php echo $name ?>config-submit" type="submit" value="Update" /></div>
    <input type="hidden" name="formtype" value="<?php echo $_GET['config'] ?>">
    
    </fieldset> 
    </div>
     <script type="text/javascript"> 
        function formCallback(result, form) { window.status = "valiation callback for form '" + form.id + "': result = " + result; }
        var valid = new Validation('<?php echo $name ?>', {immediate : true, onFormValidate : formCallback});
    </script> 
<?php } ?>
