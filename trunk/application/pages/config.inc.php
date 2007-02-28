<h1>Configuration</h1>
<?php
if (in_array($domainadminsou,$mynetworkdetails[0]['memberof']) or $userinfo['username'] == $phpadadmin->configusername) { 
			if (isset($_POST['Submit']))
			{
				$phpadadmin->writeconfig($configfile,$config);
			} else { 
				$phpadadmin->renderconfig($config);
			}
} else {
echo "<center><b>Access Denied</b></center><br>";
echo "<center><b>!!! you do not have the correct access to view this function !!!</b></center>";
}
 ?>