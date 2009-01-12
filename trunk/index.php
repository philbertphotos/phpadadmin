<?php require_once('config.php') ?>
<?php include('header.php') ?>
<div id="mainmenu"> 
    <ul id="tabs"> 
        <li>
            <a href="#search">Search</a> 
        </li>
<?php //if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
        <li>
            <a href="#results">Search Results</a>
        </li>  
<?php //} ?>
    </ul> 
<div>
<?php
$attrs = _get_attributes(false,TRUE);
?>
<div class="bar">&nbsp;</div>
<div class="panel" id="search">
<form id="search" action="#results" method="post">
<fieldset> 
<div class="field-label">
    <label for="<?php echo $attr['attr'] ?>"><?php echo $attr['displayattr'] ?></label>:
</div>
<?php foreach ($attrs as $attr) { ?>
<div class="field-label">
    <label for="<?php echo $attr['attr'] ?>"><?php echo $attr['displayattr'] ?></label>:
</div>
 <div class="field-widget"> 
       <input name="<?php echo $attr['attr'] ?>" <?php if (isset($attr['validation'])) { echo 'class="'.$attr['validation'].'"'; } ?>>
       
 </div>
<?php }?>
 <div class="field-widget"><input name="search" type="submit" value="Search" /></div> 
</fieldset>

</form>
</div>
<?php // if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
 <div class="panel" id="results">
hello mum
        <br>
 </div>                   
<?php // } ?>  
                     <script type="text/javascript"> 
                        function formCallback(result, form) {
                            window.status = "valiation callback for form '" + form.id + "': result = " + result;
                        }
                        
                        var valid = new Validation('search', {immediate : true, onFormValidate : formCallback});
                    </script>           
<?php include('footer.php') ?>