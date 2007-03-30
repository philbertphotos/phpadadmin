<h1>Search the Directory</h1>
<?php if ($_SERVER['REQUEST_METHOD'] == "GET")
	{ ?>
<form method="post">
<table align="center">
	<tr>
		<td>Display name:</td>
		<td><input type="text" name="displayname"></td>
		<td>Domain:</td>
		<td><select name="domain">
		<?php 
		foreach ($phpadadmin->domainconfig as $key => $value) 
			{
			echo "<option value='".$key."'>".$key."</option>";
			}
		
?>
		
		</td>
	</tr>
	<tr>
		<td>First name:</td>
		<td><input type="text" name="givenname"></td>
		<td>Last name:</td>
		<td><input type="text" name="sn"></td>
	</tr>
	<tr>
		<td>Title:</td>
		<td><input type="text" name="title"></td>
		<td>Alias:</td>
		<td><input type="text" name="alias"></td>
	</tr>
	<tr>
		<td>Company:</td>
		<td><input type="text" name="company"></td>
		<td>Department:</td>
		<td><input type="text" name="department"></td>
	</tr>
	<tr>
		<td>Office:</td>
		<td><input type="text" name="office"></td>
		<td colspan="2"></td>
	</tr>
	<tr>
		<td>City:</td>
		<td><input type="text" name="city"></td>
		<td colspan="2"></td>
	</tr>
	<tr>
		<td colspan="4" align="right"><input type="submit" name="search" value="Search"></td>
	</tr>
	</table>
	</form>
<?php } 
if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['search'] == "Search")
	{
	echo "were searching baby!<br>";
	
	$filter='(&(sn="'.$_POST['sn'].'")(givenname="'.$_POST['givenname'].'"))';
	echo $filter;
	$field=array("sn","givenname");
	$output=$phpadadmin->adquery2($filter,$field,$_POST['domain']);
	
	echo "dn= ".$phpadadmin->domainconfig[$domain]['domaindn'];
	
	}



?>

