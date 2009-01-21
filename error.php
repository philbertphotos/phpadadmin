<?php require_once('config.php') ?>   
<?php include ('templates/header.php') ?>

<div class=errorwrap>
      <h5>Error <?php echo $_GET['error'] ?></h5>
      <?php _dbquery('SELECT * FROM '.$db_database.',errors WHERE `id` = '.$_GET['error'],MYSQL_ASSOC,true); ?>
</div>

<?php include ('templates/footer.php') ?>
