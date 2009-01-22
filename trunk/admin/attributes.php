<?php require_once('../env.php') ?> 
<?php include('../header.php') ?>
<?php $attrs = _get_attributes(true);  ?>
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
 <form name="<?php echo $attr['attr'] ?>" action="updateattrs.php" method="post">
 <fieldset>  <legend>Attribute</legend>  
   <div class="form-row"> 
   <div class="field-label"><label>Attribute name in Active Directory</label>:</div>   
   <div class="field-widget"><?php echo $attr['attr'] ?> <em>the field name within Active Directory</em></div>
   </div>
   <div class="form-row"> 
   <div class="field-label"><label for="displayattr">Attribute Display Name</label>:</div>
    <div class="field-widget"><input class="required" type="text" name="displayattr" value="<?php echo htmlentities($attr['displayattr']) ?>"></div>
   </div>
   <div class="form-row">
   <div class="field-label"><label for="desc">Description</label>:</div>    
   <div class="field-widget"><input type="text" name="desc" value="<?php echo htmlentities($attr['desc']) ?>"> <em>Add a description to the field to help explain it to the user, like this one :)</em></div>
   </div>
   </fieldset>  
   <fieldset>  <legend>Attribute Permissions</legend>
   <div class="form-row"> 
   <div class="field-label"><label for="uservisable">User Visable</label>:</div>
    <div class="field-widget"><input type="checkbox" name="uservisable" value="<?php echo $attr['uservisable'] ?>" <?php if ($attr['uservisable']== 'TRUE') { ?>checked="YES" <?php } ?>> <em>Is the attribute visable for the users to edit?</em></div>
   </div>
   <div class="form-row"> 
   <div class="field-label"><label for="Required">Required?</label>:</div>    
   <div class="field-widget"><input type="checkbox" name="required" value="<?php echo $attr['required'] ?>" <?php if ($attr['required']== 'TRUE') { ?>checked="YES" <?php } ?>> <em>Is the field required or optional?</em></div>
   </div>
   <div class="form-row"> 
   <div class="field-label"><label for="User Edit">User Edit</label>:</div>  
    <div class="field-widget"><input type="checkbox" name="useredit" value="<?php echo $attr['useredit'] ?>" <?php if ($attr['useredit']== 'TRUE') { ?>checked="YES" <?php } ?>> <em>Is the field editable by the users?</em></div>
   </div>
   <div class="form-row"> 
   <div class="field-label"><label for="manageredit">Manager Edit</label>:</div>  
   <div class="field-widget"><input type="checkbox" name="manageredit" value="<?php echo $attr['manageredit'] ?>" <?php if ($attr['manageredit']== 'TRUE') { ?>checked="YES" <?php } ?>> <em>Is the field editable by line managers and higher?</em></div>
   </div>
   </fieldset>
    <fieldset>  <legend>Search Attributes</legend>    
   <div class="form-row"> 
   <div class="field-label"><label for="search">Searchable?</label>:</div>     
    <div class="field-widget"><input type="checkbox" name="search" value="<?php echo $attr['search'] ?>" <?php if ($attr['search']== 'TRUE') { ?>checked="YES" <?php } ?>> <em>Is the field to appear as a searchable field in the directory search?</em></div>
    </div>
       <div class="form-row"> 
   <div class="field-label"><label for="returninsearch">Appear In Search Results</label>:</div>     
    <div class="field-widget"><input type="checkbox" name="returninsearch" value="<?php echo $attr['returninsearch'] ?>" <?php if ($attr['returninsearch']== 'TRUE') { ?>checked="YES" <?php } ?>> <em>Is the field to appear in search results?</em></div>
    </div>
    </fieldset>
    <fieldset>  <legend>Form Options</legend>     
<div class="form-row">
<div class="field-label"><label for="formtype">Form Type</label>:</div>   
 <?php
   $formtypes= _dbquery('SELECT * FROM '.$db_database.'.formtype',MYSQL_ASSOC);                   
 ?>
       <SELECT name="formtype">
       <?php foreach ($formtypes as $formtype) { ?>
         <option value="<?php echo $formtype['value'] ?>" <?php if ($formtype['value'] == $attr['formtype']) { ?>selected="yes"<?php } ?> ><?php echo $formtype['name'] ?></option>
        <?php } ?> 
       </SELECT>  <em>The type of html form field the users will use to input</em>
    </div>
    <div class="form-row">
    <div class="field-label"><label for="options">Options</label>:</div>  
    <div class="field-widget"><input type="text" name="options" value="<?php echo htmlentities($attr['options']) ?>"> <em>for Drop down lists & radio buttons use comma seperated options, for textbox use width & height i.e. (rows="5" cols="50")</em></div>
    </div>
    <div class="form-row">
    <div class="field-label"><label for="validation">Validation</label>:</div> 
    <div class="field-widget">
 <?php
   $validationtypes= _dbquery('SELECT * FROM '.$db_database.'.validationtype',MYSQL_ASSOC);                   
 ?>
       <SELECT name="validation">
       <?php foreach ($validationtypes as $validationtype) { ?>
         <option value="<?php echo $validationtype['value'] ?>" <?php if ($validationtype['value'] == $attr['validation']) { ?>selected="yes"<?php } ?> ><?php echo $validationtype['name'] ?></option>
        <?php } ?> 
       </SELECT> <em>Choose the type of form validation</em>
    </div>
    </div>
    </fieldset>
    <input type="hidden" name="id" value="<?php echo $attr['id'] ?>">
    <input type="hidden" name="attr" value="<?php echo $attr['attr'] ?>">
    <fieldset>  <legend>Attribute Postion</legend>        
    <div class="form-row">
        <div class="field-label"><label for="order">Attribute Order</label>:</div>     
        <div class="field-widget"><input class="required validate-digits"  size="3" type="text" name="order" value="<?php echo $attr['order'] ?>"> <em>Arbitary number that orders the fields presented to the users, lower numbers go higher up.</em></div>
    </div>
    </fieldset>
    <div class="form-row">
         
        <div class="field-widget"><input name="<?php echo $attr['attr'] ?>-submit" type="submit" value="Update" /></div>
    </div>
 </form>

 </div>
                      <script type="text/javascript"> 
                        function formCallback(result, form) {
                            window.status = "valiation callback for form '" + form.id + "': result = " + result;
                        }
                        
                        var valid = new Validation('<?php echo $attr['attr'] ?>', {immediate : true, onFormValidate : formCallback});
                      </script>
 <?php 
 
 if (isset($i)) { $i++; } else { $i=0; } 
 
 
 } ?>

<?php include (INSTALLPATH.'templates/footer.php');   ?>