<?php
  require_once('config.php');
 
  $attrs = _dbquery('SELECT * FROM phpadadmin.attributes',MYSQL_ASSOC,false)    ;
 // $smarty->assign('pagetitle', 'testing');
 include ('header.php');  
   include ('menu.php') ;
  ?>
  
  
  
<table>
 <thead>
    <th>Attribute</th>
    <th>in AD</th>
    <th>User Visble</th>
    <th>User Edit</th>
    <th>Manager Edit</th>
    <th>searchable</th>
    <th>Form Type</th>
    <th>options</th>
    <th>validation</th>
    <th>description</th>
    <th>update</th>
 </thead>
 <?php $i=0; foreach ($attrs as $attr) { ?>
 <form name="<?php echo $attr['attr'] ?>-form" action="updateattrs.php" method="post">
 <tr <?php if($i % 2) { ?>bgcolor="lightgrey"<?php } ?>>
    <td><input type="text" name="displayattr" value="<?php echo $attr['displayattr'] ?>"></td>
    <td><?php echo $attr['attr'] ?></td>
    <td><input type="checkbox" name="uservisable" value="<?php echo $attr['uservisable'] ?>" <?php if ($attr['uservisable']== 'TRUE') { ?>checked="YES" <?php } ?>></td>
    <td><input type="checkbox" name="useredit" value="<?php echo $attr['useredit'] ?>" <?php if ($attr['useredit']== 'TRUE') { ?>checked="YES" <?php } ?>></td>
    <td><input type="checkbox" name="manageredit" value="<?php echo $attr['manageredit'] ?>" <?php if ($attr['manageredit']== 'TRUE') { ?>checked="YES" <?php } ?>></td>
    <td><input type="checkbox" name="search" value="<?php echo $attr['search'] ?>" <?php if ($attr['search']== 'TRUE') { ?>checked="YES" <?php } ?>></td>
    <td>
 <?php
   $formtypes= _dbquery('SELECT * FROM '.$db_database.'.formtype',MYSQL_ASSOC,false);                   
 ?>
       <SELECT name="formtype">
       <?php foreach ($formtypes as $formtype) { ?>
         <option value="<?php echo $formtype['value'] ?>" <?php if ($formtype['value'] == $attr['formtype']) { ?>selected="yes"<?php } ?> ><?php echo $formtype['name'] ?></option>
        <?php } ?> 
       </SELECT>
    </td>
    <td><input type="text" name="options" value="<?php echo $attr['options'] ?>"></td>
    <td>
 <?php
   $validationtypes= _dbquery('SELECT * FROM '.$db_database.'.validationtype',MYSQL_ASSOC,false);                   
 ?>
       <SELECT name="validation">
       <?php foreach ($validationtypes as $validationtype) { ?>
         <option value="<?php echo $validationtype['value'] ?>" <?php if ($validationtype['value'] == $attr['validation']) { ?>selected="yes"<?php } ?> ><?php echo $validationtype['name'] ?></option>
        <?php } ?> 
       </SELECT>
    </td>
    <td><input type="text" name="desc" value="<?php echo $attr['desc'] ?>"></td>
    <input type="hidden" name="id" value="<?php echo $attr['id'] ?>">
    <td><input  size="3" type="text" name="order" value="<?php echo $attr['order'] ?>"></td> 
    <td><input name="<?php echo $attr['attr'] ?>-submit" type="submit" value="Update" /></td>
 </tr>
 </form>
 <?php $i++; } ?>
 </table>
<?php include ('footer.php');   ?>