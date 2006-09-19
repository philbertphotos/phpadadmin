<?php
$departmentfile = 'includes/departments.txt';
if ($debug==true)
	{
	if (file_exists($departmentfile)) {
	   echo "The file $departmentfile exists<br>";
	} else {
	   die ("<center>The file $departmentfile cannot be found!</center>");
	}
	}
$departmentcontents = file($departmentfile);
asort($departmentcontents);
?>
