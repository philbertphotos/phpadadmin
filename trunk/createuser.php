<?php 

$ojectclass = "user";

?>
<form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>Create User</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Username </td>
      <td><input name="username" type="text" id="username" />*</td>
    </tr>
    <tr>
      <td>Firstname </td>
      <td><input name="firstname" type="text" id="firstname" />
      * </td>
    </tr>
    <tr>
      <td>Lastname </td>
      <td><input name="lastname" type="text" id="lastname" />
      * </td>
    </tr>
    <tr>
      <td>Job Title </td>
      <td><input name="jobtitle" type="text" id="jobtitle" />
      * </td>
    </tr>
    <tr>
      <td valign="top">Groups</td>
      <td><span class="style1">
        <label> 
		<?php for ($i=0; $i<$allgroups["count"]; $i++)
     {
			?>
          
          <input type="checkbox" name="<?php echo str_replace(" ", "-sp-" ,$allgroups[$i]["cn"][0]); ?>" value="<?php echo str_replace(" ", "-sp-" ,$allgroups[$i]["cn"][0]); ?>" />
          <?php echo $allgroups[$i]["cn"][0]; ?>
          <br />
          <?php }
	 ?>
        </label>
      </span> </td>
    </tr>
    <tr>
      <td height="28">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
    <input type="submit" name="Submit" value="Submit" />
    <label>
    <input type="reset" name="Submit2" value="Reset" />
    </label>
</p>
</form>
<?php 
		if ( empty($_POST['username']) or empty($_POST['firstname']) or empty($_POST['lastname']) or empty($_POST['jobtitle']))
		{
		echo "* Fill in all Fields";		
		} else {



		$displayname = $_POST['lastname']." ".$_POST['firstname']." - ".$_POST['jobtitle'];
		$dn ="CN=".$displayname.",".$createusersou ;
		echo "<br>";
		echo "DN = ".$dn;
		echo "<br>";
		echo "samaccountname = ".$_POST['username'] ;
		echo "<br>";
		echo "ojectclass = ".$ojectclass ;
		echo "<br>";
		echo "displayname = ".$displayname ;
		
		$update["sn"]=$_POST['lastname'];
		$update["givenname"]=$_POST['firstname'];
		$update["displayname"]=$displayname ;
		$update["objectclass"]=$ojectclass ;
		$update["samaccountname"]=$_POST['username'];
ldap_add($ad, $dn.",".$domaindn, $update);
echo "this is the DN = ".$dn.$domaindn;
 			//Create Member of Array	

				for ( $ii=0; $ii<$allgroups["count"]; $ii++)
					 {				
						$allgroup22=$allgroups[$ii]['cn'][0];
						
						$allgroup21=str_replace(" ", "-sp-" ,$allgroup22); //replace any spaces in groups names with -sp-
						
						if (isset($_POST[$allgroup21])) 
							{ 
							
							$selectedgroupdn=$allgroups[$ii]['dn'];
							echo "<br>".$selectedgroupdn."<br>";
							$group_info["member"] = $dn.",".$domaindn; // User's DN is added to group's 'member' array
							ldap_mod_add ($ad, $selectedgroupdn, $group_info);
							//print_r($_POST[$allgroup21]);
							echo "selected group".$selectedgroupdn."<br>";
							echo "posted vars".$_POST[$allgroup21]."<br>";
							echo "group info "; print_r($group_info);
							}
					 }




		
		}
?>