<h1>Welcome <?php echo $mynetworkdetails[0]['givenname'][0]." ".$mynetworkdetails[0]['sn'][0]; ?></h1>
<h2>check question</h2>
<?php 
$uid=$phpadadmin->getdbuserid();
if ($_SERVER['REQUEST_METHOD'] == "GET")
	{
?>
	<form method="post">
	<?php
	 
	 $questions=$phpadadmin->getdbuserquestions($uid);
	 ?>
	<select name="question">
	<?php 
	 for ($i=0; $i<count($questions); $i++)
		{
		$q = rtrim($questions[$i]['question']);
		echo "<option value='".$q."'>".$q."</option>";
		}
	?>
	<input name="answer" type="password"><input type="submit" value="check question" name="checkquestion"></form>
	<?php 
	}
if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
	$phpadadmin->checkdbquestion($uid,$_POST['question'],$_POST['answer']);
	}
?>
