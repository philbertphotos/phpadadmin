<?php
require_once('../env.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
       echo '<pre>';print_r($_POST);echo '</pre>'; 
      $valuenames = _dbquery('SELECT `name` FROM '.$db_database.'.config WHERE `type` = \''.$_POST['formtype'].'\';',MYSQL_ASSOC,true);  
      foreach ($valuenames as $name)
        {
         if (isset($_POST[$name['name']])) {
             $sql = 'UPDATE `'.$db_database.'`.`config` 
                     SET `value` = \''.$_POST[$name['name']].'\' 
                     WHERE `config`.`id` = '.$_POST[$name['name'].'-id'].' LIMIT 1 ;
                     ;';
            
            _dbupdate($sql); 
            }
        }
      
                                                 
      header('Location: '.PATH.'admin/configuration.php?config='.$_POST['formtype'] ); 
    }
?>