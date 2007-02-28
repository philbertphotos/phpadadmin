<?php
foreach ($_POST as $key => $value) 	{
	
	$update[$key]=$value  ;
	
	}
	echo "<pre>";
print_r($update);
echo "</pre>";
?>