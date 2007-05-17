<?php $foldersou="OU=Folders,OU=Architecture,OU=Service Admin,DC=pht-master,DC=xports,DC=nhs,DC=uk"; ?>
<h1>My Folders</h1>
<h2>Folders I manage</h2>
<?php
$folderfilter="(objectclass=volume)";
$foldermanager=$phpadadmin->adquery2($folderfilter,array("uncname","keyword","name","managedby"),$userinfo['domain']);

?>
<pre>
<?php 
for ($i=0; $i<$foldermanager['count']; $i++)
 	{
	 if (isset($foldermanager[$i]['managedby'][0]))
	    {
	 	if($foldermanager[$i]['managedby'][0] == $mynetworkdetails[0]['dn'])
	 	{
		echo "<a href=\"".$foldermanager[$i]['uncname'][0]."\">".$foldermanager[$i]['name'][0]."</a> Manage";
		}
		}
	}

for ($i=0; $i<$mynetworkdetails[0]['memberof']['count']; $i++)
	{
		
		$groupcn=explode(',',$mynetworkdetails[0]['memberof'][$i]);
		
		if (preg_match("/(.*?)_(.*?)_RW$/",$groupcn[0]))
			{
			$readwritegroup=$groupcn[0];
			}
		if (preg_match("/(.*?)_(.*?)_RO$/",$groupcn[0]))
			{
			$readgroup=$groupcn[0];
			}
		if (preg_match("/(.*?)_(.*?)_RWM$/",$groupcn[0]))
			{
			$readwritemanagegroup=$groupcn[0];
			}			
	}
echo"<pre>"; print_r($readwritemanagegroup); echo "</pre>";

 ?>
 
</pre>
<h2>Folders I have read & write access</h2>
<?php echo"<pre>"; print_r($readwritegroup); echo "</pre>" ?>
<h2>Folders I have read access</h2>
<?php echo"<pre>"; print_r($readgroup); echo "</pre>" ?>
