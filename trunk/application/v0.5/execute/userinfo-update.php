<?php
if (isset($_POST['Submit'])) {
foreach ($config['User Edit'] as $key => $value) 
	{
	if ($value['value']=="TRUE")
		{	
		if (isset($_GET['debug']) && $_GET['debug'] == "true") { echo $_POST[$value['adattrib']]." ".$key."<br>"; }
		$update[$value['adattrib']]=$_POST[$value['adattrib']]; 
		}
	}
$dn=$mynetworkdetails[0]['dn'];
$phpadadmin->updateaccount2($update,$dn,$userinfo['domain'])
?>
<center><a href="?">Your Details Have been Update</a></center>
<?php } else { ?>
<center>Nothing to process</center>
<?php } ?>