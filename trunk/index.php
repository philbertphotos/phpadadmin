<?php
  require_once('config.php');
        $sql='SELECT * FROM phpadadmin.attributes WHERE uservisable = \'TRUE\' ORDER BY `order`;';
  $attrs = _dbquery($sql,MYSQL_ASSOC,false)    ;

  include ('header.php');
  
  include ('menu.php') ;
  ?>
  
<form id="test" action="#" method="get">  
<legend>Update your user attributes</legend>
 <fieldset> 
 <?php $i=0; foreach ($attrs as $attr) { ?>
 <div class="form-row"> 
   <div class="field-label"><label for="field1"><?php echo $attr['displayattr'] ?></label>:</div>
   <div class="field-widget"><input name="field1" id="field1" class="<?php if (isset($attr['required']) && $attr['required'] == 'TRUE' ) { echo 'required '; }; if (isset($attr['validation'])) { echo $attr['validation']; } ?>" /></div>
 </div>

 <?php $i++; } ?>
 </fieldset>
 </form>
 
                     <script type="text/javascript"> 
                        function formCallback(result, form) {
                            window.status = "valiation callback for form '" + form.id + "': result = " + result;
                        }
                        
                        var valid = new Validation('test', {immediate : true, onFormValidate : formCallback});
                        Validation.addAllThese([
                            ['validate-password', 'Your password must be more than 6 characters and not be \'password\' or the same as your name', {
                                minLength : 7,
                                notOneOf : ['password','PASSWORD','1234567','0123456'],
                                notEqualToField : 'field1'
                            }],
                            ['validate-password-confirm', 'Your confirmation password does not match your first password, please try again.', {
                                equalToField : 'field8'
                            }]
                        ]);
                    </script>  
 <?php include('footer.php'); ?>