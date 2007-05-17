<?php
$headings=$phpadadmin->dbquery('SELECT DISTINCT `Heading` FROM `rag`');
print_r($headings);
for ($i=0; $i < count($headings); $i++)
	{

		echo "<h2>".$headings[$i]['0']."</h2>";
		echo "<table>";
		echo "<tr><th width='100'>Name</th><th width ='100'>Status</th><th width ='100'>Site</th><th width='400'>notes</th>";
		$rag=$phpadadmin->dbquery('SELECT `rag`.`name`, `rag`.`state`, `rag`.`note` FROM `rag` WHERE `Heading` = "'.$headings[$i]['0'].'"');
		for ($c=0; $c < count($rag) ;$c++)
			{
			echo "<tr><td>".$rag[$c]['0']."</td><td bgcolor='".$rag[$c]['1']."'>".$rag[$c]['1']."</td><td>".$rag[$c]['3']."</td><td>".$rag[$c]['2']."</td></tr>";
			}
		echo "</table>";
	}

?>