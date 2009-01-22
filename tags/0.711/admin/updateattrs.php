<?php
require_once('../env.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        if (isset($_POST['useredit'])) { $useredit='TRUE'; } else { $useredit='FALSE'; }
        if (isset($_POST['required'])) { $required='TRUE'; } else { $required='FALSE'; }
        if (isset($_POST['manageredit'])) { $manageredit='TRUE'; } else { $manageredit='FALSE'; }
        if (isset($_POST['search'])) { $search='TRUE'; } else { $search='FALSE'; }
        if (isset($_POST['returninsearch'])) { $returninsearch='TRUE'; } else { $returninsearch='FALSE'; }
        if (isset($_POST['uservisable'])) { $uservisable='TRUE'; } else { $uservisable='FALSE'; }
        $sql= '
        UPDATE  `'.$db_database.'`.`attributes` SET
        `useredit` = \''.$useredit.'\',  
        `manageredit` = \''.$manageredit.'\',  
        `required` = \''.$required.'\',  
        `search` = \''.$search.'\',  
        `returninsearch` = \''.$returninsearch.'\',  
        `uservisable` = \''.$uservisable.'\',  
        `options` =  \''.mysql_escape_string($_POST['options']).'\',
        `formtype` =  \''.$_POST['formtype'].'\',
        `displayattr` =  \''.mysql_escape_string($_POST['displayattr']).'\',
        `validation` =  \''.$_POST['validation'].'\',
        `order` =  \''.$_POST['order'].'\',
        `desc` =  \''.mysql_escape_string($_POST['desc']).'\' 
        WHERE  `attributes`.`id` ='.$_POST['id'].' LIMIT 1 ;';
        echo $sql;
       _dbupdate($sql);    
    }    
header('Location: '.PATH.'admin/attributes.php#'.$_POST['attr'] );
?>