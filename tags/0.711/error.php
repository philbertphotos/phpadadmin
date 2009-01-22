<?php require_once('env.php') ?>   
<?php include ('templates/header.php') ?>
<div id="header">
<img src="<?php echo PATH ?>images/logo.gif">
</div>
<div class=clear></div>
<div id=content>
<?php $_error =  _dbquery('SELECT * FROM '.$db_database.'.errors WHERE `id` = '.$_GET['error'].';',MYSQL_ASSOC); ?>
<div class=errorwrap>
      <h5>Error <?php echo $_GET['error'] ?></h5>
      <h2><?php echo $_error[0]['title'] ?></h2>
      <p><?php echo $_error[0]['text'] ?></p>
      
</div>

<?php include ('templates/footer.php') ?>
