<?php require_once('config.php'); ?>
 
 
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
    $attributes = _dbquery('SELECT `attr` FROM '.$db_database.'.attributes ;',MYSQL_ASSOC); 
    foreach ($attributes as $attribute)
        {
          if (isset($_POST[$attribute['attr']]) && !empty($_POST[$attribute['attr']]))
            {       
             echo 'Lets update '.$attribute['attr'].' with '. $_POST[$attribute['attr']].'<br>';
             $update[$attribute['attr']]= $_POST[$attribute['attr']];
            }
            
        } 
     $phpadadmin -> user_modify($_userinfo[0]['samaccountname'][0],$update);
     header('Location: '.PATH.'myaccount.php' );  
    }
?>