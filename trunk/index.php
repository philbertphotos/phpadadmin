<?php
  require_once('config.php');
        $sql='SELECT * FROM '.$db_database.'.attributes WHERE uservisable = \'TRUE\' ORDER BY `order`;';
  $attrs = _dbquery($sql,MYSQL_ASSOC)    ;

  include ('header.php');
  ?>
<div id="mainmenu"> 
    <ul id="tabs"> 
        <li> 
            <a href="#home">Home</a> 
        </li> 
        <li> 
            <a href="#search">Search</a> 
        </li>
        <li> 
            <a href="#questions">My Security Questions</a> 
        </li>  
    </ul> 
<div>
<div class="bar">&nbsp;</div>   
  
  
  
<div class="panel" id="home">
<form id="test" action="#" method="get">    
 <fieldset>  <legend>Update your user attributes</legend> 
 <?php $i=0; foreach ($attrs as $attr) { ?>

 <?php 
 switch ($attr['formtype'])  {
    case "text": ?>
    <div class="form-row"> 
   <div class="field-label"><label for="<?php echo $attr['attr'] ?>"><?php echo $attr['displayattr'] ?></label>:</div>
   <div class="field-widget"><input name="<?php echo $attr['attr'] ?>" id="<?php echo $attr['attr'] ?>" class="<?php if (isset($attr['required']) && $attr['required'] == 'TRUE' ) { echo 'required '; }; if (isset($attr['validation'])) { echo $attr['validation']; } ?>" /> <em><?php echo $attr['desc'] ?></em></div>
   </div>
   <?php break; 
   case "dropdown":
   $options = explode(',',$attr['options']);
   ?>
                        <div class="form-row"> 
                            <div class="field-label"><label for="<?php echo $attr['attr'] ?>"><?php echo $attr['displayattr'] ?></label>:</div> 
                            <div class="field-widget"> 
                                <select id="<?php echo $attr['attr'] ?>" name="<?php echo $attr['attr'] ?>" class="validate-selection" title="Choose your <?php echo $attr['displayattr'] ?>"> 
                                    <option>Select one...</option> 
                                    <?php 
                                    
                                    foreach ($options as $option)
                                        {
                                        ?><option><?php echo $option ?></option><?php
                                        }
                                        ?>
                                </select> 
                            </div> 
                        </div> 
   <?php break;
   case "checkbox":
   ?>
   <div class="form-row"> 
    <div class="field-label"><label for="<?php echo $attr['attr'] ?>"><?php echo $attr['displayattr'] ?></label>:</div> 
    <div class="field-widget"><input id="<?php echo $attr['attr'] ?>"  type="checkbox" name="<?php echo $attr['attr'] ?>" value="TRUE"></div>
    </div>
   <?php
   break;
   case "radio":
   $radios =  explode(',',$attr['options']);
   ?>
   <div class="form-row">
  <div class="field-label"><label for="<?php echo $attr['attr'] ?>"><?php echo $attr['displayattr'] ?></label>:</div> 
  <div class="field-label"> 
   <?php foreach ($radios as $radio)   
        { ?>
    <input type="radio" name="<?php echo $attr['attr'] ?>" id="<?php echo $attr['attr'] ?>-<?php echo $radio ?>" value="<?php echo $radio ?>" /><?php echo $radio ?><br />
   <?php } ?>
   </div>
   </div>
   <?php
   break;
   case "textbox":
   ?>
   <div class="form-row">
      <div class="field-label"><label for="<?php echo $attr['attr'] ?>"><?php echo $attr['displayattr'] ?></label>:</div>
      <div class="field-widget"><textarea <?php if (isset($attr['options'])) { echo $attr['options']; } ?>name="<?php echo $attr['attr'] ?>" id="<?php echo $attr['attr'] ?>" class="<?php if (isset($attr['required']) && $attr['required'] == 'TRUE' ) { echo 'required '; }; if (isset($attr['validation'])) { echo $attr['validation']; } ?>" /></textarea></div>
  </div>
   <?php
   break;
 }?>

 <?php $i++; } ?>
 </fieldset>
 </form>
 
                     <script type="text/javascript"> 
                        function formCallback(result, form) {
                            window.status = "valiation callback for form '" + form.id + "': result = " + result;
                        }
                        
                        var valid = new Validation('test', {immediate : true, onFormValidate : formCallback});
                    </script>  
</div>
<div class="panel" id="search"> 
Search and stuff
</div>
<div class="panel" id="questions"> 
Questions
</div>
 <?php include('footer.php'); ?>