<?php
  require_once('config.php');
        $sql='SELECT * FROM phpadadmin.attributes WHERE uservisable = \'TRUE\' ORDER BY `order`;';
  $attrs = _dbquery($sql,MYSQL_ASSOC,false)    ;

  include ('header.php');
  
  include ('menu.php') ;
  ?>
  
  
  
<table>
 <?php $i=0; foreach ($attrs as $attr) { ?>
 <form name="userupdate" action="updateattrs.php" method="post">
 <tr <?php if($i % 2) { ?>bgcolor="lightgrey"<?php } ?>>
    <td><?php echo $attr['displayattr'] ?></td>
    <td><input type="text" name="displayattr" value="VALUE FROM AD" <?php if ($attr['useredit'] == 'FALSE') { ?>DISABLED<?php } ?>></td>
 
 </tr>
 </form>
 <?php $i++; } ?>
 </table>

 <?php include('footer.php'); ?>