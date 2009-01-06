<?php
 require_once('config.php');
 
  $attrs = _dbquery('SELECT * FROM phpadadmin.attributes',MYSQL_ASSOC,false)    ;
 // $smarty->assign('pagetitle', 'testing');
include ('header.php'); 
?> 
<div id="mainmenu"> 
    <ul id="tabs">
    <?php $i=0; foreach ($attrs as $attr) { ?> 
        <li> 
            <a href="#<?php echo $attr['attr'] ?>"><?php echo $attr['displayattr'] ?></a> 
        </li> 
    <?php } ?>
    </ul> 
<div>
<div class="bar">&nbsp;</div> 



 <?php $i=0; foreach ($attrs as $attr) { ?>
 <div class="panel" id="<?php echo $attr['attr'] ?>">
  <fieldset>  <legend><?php echo $attr['displayattr'] ?></legend> 
 <form name="<?php echo $attr['attr'] ?>-form" action="updateattrs.php" method="post">
   <div class="form-row"> 
   <div class="field-label"><label for="displayattr">Attribute Display Name</label>:</div>
    <div class="field-widget"><input type="text" name="displayattr" value="<?php echo htmlentities($attr['displayattr']) ?>"></div>
   </div>
   <div class="form-row"> 
   <div class="field-label"><label>Attribute name in Active Directory</label>:</div>   
   <div class="field-widget"><?php echo $attr['attr'] ?></div>
   </div>
   <div class="form-row"> 
   <div class="field-label"><label for="uservisable">User Visable</label>:</div>
    <div class="field-widget"><input type="checkbox" name="uservisable" value="<?php echo $attr['uservisable'] ?>" <?php if ($attr['uservisable']== 'TRUE') { ?>checked="YES" <?php } ?>></div>
   </div>
   <div class="form-row"> 
   <div class="field-label"><label for="Required">Required?</label>:</div>    
   <div class="field-widget"><input type="checkbox" name="required" value="<?php echo $attr['required'] ?>" <?php if ($attr['required']== 'TRUE') { ?>checked="YES" <?php } ?>></div>
   </div>
   <div class="form-row"> 
   <div class="field-label"><label for="User Edit">User Edit</label>:</div>  
    <div class="field-widget"><input type="checkbox" name="useredit" value="<?php echo $attr['useredit'] ?>" <?php if ($attr['useredit']== 'TRUE') { ?>checked="YES" <?php } ?>></div>
   </div>
   <div class="form-row"> 
   <div class="field-label"><label for="manageredit">Manager Edit</label>:</div>  
   <div class="field-widget"><input type="checkbox" name="manageredit" value="<?php echo $attr['manageredit'] ?>" <?php if ($attr['manageredit']== 'TRUE') { ?>checked="YES" <?php } ?>></div>
   </div>
   <div class="form-row"> 
   <div class="field-label"><label for="search">Attribute Searchable?</label>:</div>     
    <div class="field-widget"><input type="checkbox" name="search" value="<?php echo $attr['search'] ?>" <?php if ($attr['search']== 'TRUE') { ?>checked="YES" <?php } ?>></div>
    </div>
<div class="form-row">
<div class="field-label"><label for="formtype">Form Type</label>:</div>   
 <?php
   $formtypes= _dbquery('SELECT * FROM '.$db_database.'.formtype',MYSQL_ASSOC,false);                   
 ?>
       <SELECT name="formtype">
       <?php foreach ($formtypes as $formtype) { ?>
         <option value="<?php echo $formtype['value'] ?>" <?php if ($formtype['value'] == $attr['formtype']) { ?>selected="yes"<?php } ?> ><?php echo $formtype['name'] ?></option>
        <?php } ?> 
       </SELECT>
    </div>
    <div class="form-row">
    <div class="field-label"><label for="options">Options</label>:</div>  
    <div class="field-widget"><input type="text" name="options" value="<?php echo htmlentities($attr['options']) ?>"></div>
    </div>
    <div class="form-row">
    <div class="field-label"><label for="validation">Validation</label>:</div> 
    <div class="field-widget">
 <?php
   $validationtypes= _dbquery('SELECT * FROM '.$db_database.'.validationtype',MYSQL_ASSOC,false);                   
 ?>
       <SELECT name="validation">
       <?php foreach ($validationtypes as $validationtype) { ?>
         <option value="<?php echo $validationtype['value'] ?>" <?php if ($validationtype['value'] == $attr['validation']) { ?>selected="yes"<?php } ?> ><?php echo $validationtype['name'] ?></option>
        <?php } ?> 
       </SELECT>
    </div>
    </div>
    <div class="form-row">
    <div class="field-label"><label for="desc">Description</label>:</div>    
    <div class="field-widget"><input type="text" name="desc" value="<?php echo htmlentities($attr['desc']) ?>"></div>
    </div>
    <input type="hidden" name="id" value="<?php echo $attr['id'] ?>">
    <input type="hidden" name="attr" value="<?php echo $attr['attr'] ?>">     
    <div class="form-row">
        <div class="field-label"><label for="order">Attribute Order</label>:</div>     
        <div class="field-widget"><input  size="3" type="text" name="order" value="<?php echo $attr['order'] ?>"></div>
    </div>
    <div class="form-row">
         
        <div class="field-widget"><input name="<?php echo $attr['attr'] ?>-submit" type="submit" value="Update" /></div>
    </div>
 </form>
 </fieldset>
 </div>
 <?php $i++; } ?>
 </table>
<?php include ('footer.php');   ?>