<?php include('../config.php') ?>
<?php include('../functions/loadfunctions.php') ?>
<?php include('../templates/header.php') ?>
<div id="header">
<img src="../images/logo.gif">
</div>
<div id=content>
<div id="mainmenu"> 
    <ul id="tabs"> 
        <li> 
            <a href="#setpassword">Set AD Password</a> 
        </li>  
    </ul> 
<div>
<div class="panel" id="setpassword"> 
<form name="setpassword" action="password.php" method="post" >
<fieldset><legend>Set your AD Password</legend>
<center>
<input type="password" name="password1" ><br>
<input type="password" name="password2" class="validate-password-confirm"><br>
<?php list($domain, $username) = split('[\\]', $_SERVER["LOGON_USER"]); ?>
<input type="submit" name="submit" <?php if ($username !== $administatoruser) { ?> DISABLED <?php } ?> value="Set Password" ></center>  

</fieldset>
</form> 
                    <script type="text/javascript">
                        function formCallback(result, form) {
                            window.status = "valiation callback for form '" + form.id + "': result = " + result;
                        }
                        
                        var valid = new Validation('setpassword', {immediate : true, onFormValidate : formCallback});
                        Validation.addAllThese([
                            ['validate-password', 'Your password must be more than 6 characters and not be \'password\' or the same as your name', {
                                minLength : 1
                             
                                
                            }],
                            ['validate-password-confirm', 'Your confirmation password does not match your first password, please try again.', {
                                equalToField : 'password1'
                            }]
                        ]);

                    </script>


 </div>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST')
    { 
    _dbupdate('UPDATE `phpadadmin`.`config` SET `value` = \''.$_POST['password1'].'\' WHERE `config`.`name` = \'ad_password\' LIMIT 1 ;');     
    echo '<center><b>updated</b></center>';
    echo '<center><b>     <a href="../admin/configuration.php?config=ldap">Configure Ldap Settings</a> </b></center>';
    }
?>
<?php include('../templates/footer.php') ?>

