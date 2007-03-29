<h1>My Security Questions</h1>

<table width="400px" align="center">
<?php 
$continue="<br><a href='?page=mysecurityquestions'>continue</a></center>";
$phpadadmin->dbconnect();
$sqluser=$userinfo['username']."@".$phpadadmin->domainconfig[$userinfo['domain']]['fqdn'];
$sql = 'SELECT * FROM `users` WHERE samaccountname = "'.$sqluser.'"';
$result = mysql_query($sql);
$result = mysql_fetch_row($result);
$uid=$result['0'];
if ( $result['1'] == $sqluser)
	{
		if (!isset($_GET['edit']) and !isset($_GET['save']) and !isset($_GET['delete']) and !isset($_GET['add']) and $_SERVER['REQUEST_METHOD'] != "POST"){	
		?>
		<table width="400px" align="center">
			<tr>
				<th>Question</th>
				<th>Answer</th>
				<th></th>
			</tr>
		<?php
			$sql = 'SELECT  `index` , `question` , `answer` FROM `questions` WHERE `uid` = "'.$result['0'].'"';
		$result = mysql_query($sql);
		while ($questions = mysql_fetch_array($result))
			{
			echo "<tr><td>".$questions['question']."</td><td>***********</td><td><a href='index.php?page=mysecurityquestions&edit=".$questions['index']."'>edit</a></td><tr>";
			}
		?>
		<tr><td></td><td></td><td><a href='index.php?page=mysecurityquestions&add'>Add new</a></td>
		</table>
		<?php 
		}
		if (isset($_GET['edit']) and $_SERVER['REQUEST_METHOD'] != "POST")
			{
		echo "yeah baby we're editing";
		$sql = 'SELECT * FROM `questions` WHERE `index` = "'.$_GET['edit'].'" AND `uid` = "'.$uid.'"';
		$result = mysql_query($sql);
		$result = mysql_fetch_array($result);
		?><form id="editquestionid-<?php echo $_GET['edit'] ?>" name="editquestionid-<?php echo $_GET['edit'] ?>" method="post" action="">
		<table width="400px" align="center">
			<tr>
				<th>Edit Question</th>
				<th>Edit Answer</th>
				<th></th>
				<th></th>
			</tr>
			<tr>
				<td><input name="newquestion" type="text" value="<?php echo $result['question'] ?>"></td>
				<td><input name="newanswer" type="password" value="<?php echo $result['answer'] ?>"></td>
				<td><input type="submit" name="save" value="save"></td>
				<td><input type="submit" name="delete" value="delete"></td>
			</tr><input type="hidden" name="index" value="<?php echo $_GET['edit']; ?>">
			<?php
			}
		if ($_SERVER['REQUEST_METHOD'] = "POST" and $_POST['add'] == "add" )
			{
			if (strlen($_POST['question']) < $phpadadmin->minquestionlength or strlen($_POST['answer']) < $phpadadmin->minanswerlength )
				{
				echo "The question cannot be shorter than ".$phpadadmin->minquestionlength." characters";
				echo "<br>";
				echo "The answer cannot be shorter than ".$phpadadmin->minanswerlength." characters";
				echo $continue;
				} else {
					$sql = "INSERT INTO `questions` (`index`, `uid`, `question`, `answer`) VALUES (NULL, ".$uid.", '".$_POST['question']."', '".$_POST['answer']."');";
					echo $sql;
					mysql_query($sql);
				}
			}
		if ($_SERVER['REQUEST_METHOD'] = "POST" and $_POST['save'] == "save" )
			{		
			//if (empty($_POST['newquestion']) or empty($_POST['newanswer']))
			if (strlen($_POST['newquestion']) < $phpadadmin->minquestionlength or strlen($_POST['newanswer']) < $phpadadmin->minanswerlength )
				{
				echo "The question cannot be shorter than ".$phpadadmin->minquestionlength." characters";
				echo "<br>";
				echo "The answer cannot be shorter than ".$phpadadmin->minanswerlength." characters";
				echo $continue;
				} else {
				$sql = "UPDATE `questions` SET `question` = '".$_POST['newquestion']."', `answer` = '".$_POST['newanswer']."' WHERE `questions`.`index` = ".$_GET['edit']." LIMIT 1;";
				mysql_query($sql);
				echo "<center>Saved<br>";
				echo $continue;
				
				}
			}
		if ($_SERVER['REQUEST_METHOD'] = "POST" and $_POST['delete'] == "delete" )
			{
				$sql="DELETE from `questions` WHERE `index` = '".$_POST['index']."'";
				echo "Question has been deleted<br>";
				mysql_query($sql);
				echo $continue;
			}
		if (isset($_GET['add']))
			{
			?><form id="addquestion" name="addquestion" method="post" action="">
			  <table width="400px" align="center">
					<tr>
						<td colpan="2">Enter your new Question and Answer</td>
					</tr>
					<tr>
						<th>Question</th>
						<th>Answer</th>
					<tr>
					<tr>
						<td><input type="text" name="question"></td>
						<td><input type="text" name="answer"></td>
					</tr>
					<tr>
						<td></td><td><input type="submit" name="add" value="add"></td>
					</tr>
					<tr><td colspan="2">
					<?php
				echo "A question cannot be shorter than <b>".$phpadadmin->minquestionlength." characters</b> and ";
				//echo "<br>";
				echo "an answer cannot be shorter than <b>".$phpadadmin->minanswerlength." characters</b>";					
					?>
					</td>
			<?php

			}
	} else {
	$sql = 'INSERT INTO `users` (`index`, `samaccountname`) VALUES (NULL, \''.$sqluser.'\');';
	mysql_query($sql) or die("couldn't add user to db");
	echo "<a href='".$_SERVER[URL]."'>Click here to continue</a>";
	exit;
	}

 ?>
