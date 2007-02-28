
<?php
$i=0;
foreach ($_POST as $key => $value)
	{
		
		if ($key=="Submit" or $key =="domainadmins") { }else
		{
			if (preg_match("/(.*?)-type$/",$key))
			 {
			 $line[$i][0]=$value.",";
			 //echo $value.",";
			 } else {
			 	if (preg_match("/(.*?)-id$/",$key))
					{
			 $line[$i][1]=$value.",";
			 //echo $value.",";			
					} else {	
				if (preg_match("/(.*?)-sys$/",$key))
				    {
					$system[$key]=$value;
					
					} else {
				if (preg_match("/(.*?)-department$/",$key))
					{
					$department[$key]=$value;
					} else {	
					 $line[$i][2]=$key.",".$value;
						//echo $key.",".$value."<br>";
								$i=$i+1;
					}}}
			 }
		}///

	}
	
echo "<pre>";print_r($_POST);echo "</pre>";

	//unlink("config/config.csv");


for ($i=0; $i<count($line); $i++)
	{
			$writeline=$line[$i][0].$line[$i][1].$line[$i][2]; 

			
		$phpadadmin->writefileline("config/config.csv",$writeline."\n");
		//echo $writeline."<br>";
	
	}
// write system lines
foreach ($system as $key => $value)
	{
	$writeline="system,".substr($key,0,-4).",".str_replace(",","|",$value);
	$phpadadmin->writefileline("config/config.csv",$writeline."\n");
		}
// write department lines
foreach ($department as $key => $value)
	{
	
	$writeline="department,".substr($key,0,-12).",".str_replace(",","|",$value);
	$phpadadmin->writefileline("config/config.csv",$writeline."\n");
		}

?>
<p>Configuration has been applied</p>
<p><a href="?page=config">Return </a></p>
<pre><?php  print_r($department) ?></pre>
