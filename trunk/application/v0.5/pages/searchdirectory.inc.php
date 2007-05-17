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
	$filter='(&(sn='.$_POST['sn'].'*)(givenname='.$_POST['givenname'].'*))';
	$field=array("sn","givenname","displayname","office","department","mobile","telephonenumber");
	$output=$phpadadmin->adquery2($filter,$field,$_POST['domain']);
	
	?>
	<table width="100%">
		<tr>
			<th>First name</th>
			<th>Last name</th>
			<th>Telephone number</th>
			<th>Mobile number</th>
			<th>Office</th>
			<th>Department</th>
		</tr>
		
	<?php
	$color1="#FFFFFF";
	$color2="#C5D1E1";
	for($i = 0; $i < count($output); $i++) 
		{
		$row_color = ($i % 2) ? $color2 : $color1; 
		echo "<tr>\n";
		echo "	<td bgcolor=".$row_color.">".$output[$i]['givenname']['0']."</td>\n";
		echo "	<td bgcolor=".$row_color.">".$output[$i]['sn']['0']."</td>\n";
		echo "	<td bgcolor=".$row_color.">".$output[$i]['telephonenumber']['0']."</td>\n";
		echo "	<td bgcolor=".$row_color.">".$output[$i]['mobile']['0']."</td>\n";
		echo "	<td bgcolor=".$row_color.">".$output[$i]['office']['0']."</td>\n";
		echo "	<td bgcolor=".$row_color.">".$output[$i]['department']['0']."</td>\n";
		echo "</tr>\n";
		}

	}
	
$functions = $phpadadmin->getdbfunctions("both");
	echo "<pre>";
print_r($functions);
echo "</pre>";
$functions = $phpadadmin->getdbfields("both");
	echo "<pre>";
print_r($functions);
echo "</pre>";
?>

