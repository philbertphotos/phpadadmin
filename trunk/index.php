<?php require_once('config.php') ?>
<?php require_once('functions/loadfunctions.php');  ?>   
<?php include('header.php') ?>

<div id="mainmenu"> 
    <ul id="tabs"> 
        <li>
            <a href="#search">Search</a> 
        </li>
    </ul> 
<div>
<?php
if ($_config['ldap']['exchangeinstalled'] == 'TRUE') 
    {
     $sql = 'SELECT `attr`,`displayattr` FROM attributes WHERE search = \'TRUE\' ';
    } else {
     $sql = 'SELECT `attr`,`displayattr` FROM attributes WHERE search = \'TRUE\' AND requireexchange = \'FALSE\' ';    
    }
$attrs =_dbquery($sql,MYSQL_ASSOC)    ;
?>
<div class="bar">&nbsp;</div>
<div class="panel" id="search">
<form id="search" action="#results" method="post">
<fieldset> 
<?php foreach ($attrs as $attr) { ?>
<div class="field-label">
    <label for="<?php echo $attr['attr'] ?>"><?php echo $attr['displayattr'] ?></label>:
</div>
 <div class="field-widget"> 
       <input name="<?php echo $attr['attr'] ?>" <?php if (isset($attr['validation'])) { echo 'class="'.$attr['validation'].'"'; } ?>>
       
 </div>
<?php }?>
 <div class="field-widget"><input DISABLED name="search" type="submit" value="Search" /></div> 
</fieldset>

</form>

</div>
      <script type="text/javascript"> 
        function formCallback(result, form) {
            window.status = "valiation callback for form '" + form.id + "': result = " + result;
        }
        var valid = new Validation('search', {immediate : true, onFormValidate : formCallback});
    </script>          
<?php include('templates/footer.php') ?>
