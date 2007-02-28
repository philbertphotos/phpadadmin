<h1>My Search</h1>
<form id="Search" name="Search" method="post" action="<?php echo $_SERVER['PHP_SELF']."?page=".$_GET['page'];?>">
  <table width="100%" border="0" cellspacing="0" cellpadding="3">
    <tr valign="middle">
      <td width="23%">Firstname 
      <input name="firstname" type="text" id="firstname" /></td>
      <td width="64%">Lastname 
      <input name="lastname" type="text" id="lastname" /></td>
      <td width="13%"><input type="submit" name="Submit" value="Search" /></td>
    </tr>
	<tr>
	<td colspan="3"><small>Note : Maximum number of results returned is 1000</small> </td>
	</tr>
  </table> 
</form>
<?php
if (isset($_POST['Submit']) && $_POST['Submit']=="Search") 
{

if (!empty($_POST['firstname'])) { $firstname=$_POST['firstname']; } else { $fistname="" ; }
if (!empty($_POST['lastname'])) { $lastname=$_POST['lastname']; } else {$lastname="" ;}
$mysearch=$phpadadmin->adquery2("(&(givenname=".$firstname."*)(sn=".$lastname."*))",array("givenname","sn","mail","telephonenumber","company","displayname"),$userinfo['domain'])

?>
<table width="100%" border="0" cellpadding="1" cellspacing="0">
  <tr>
    <th>Name</th>
    <th>Display Name </th>
    <th>Phone Number </th>
    <th>Email Address </th>
    <th>Company</th>
  </tr>
<?php
$c=0;
for ($i=0; $i<$mysearch['count']; $i++)
	{

		if (isset($mysearch[$i]['mail'][0])) {
		
		$c=$c+1; 
			 if ( $c%2 == 0 )
			 echo "<tr bgcolor=\"#CDDEF2\" >";
			 else
			 echo "<tr bgcolor=\"#ffffff\">"; 
		echo "<td>".$mysearch[$i]['givenname'][0]." ".$mysearch[$i]['sn'][0]."</td>";
		if (isset($mysearch[$i]['displayname'][0])) { echo "<td>".$mysearch[$i]['displayname'][0]."</td>"; } else { echo "<td></td>"; }
		if (isset($mysearch[$i]['telephonenumber'][0])) { echo "<td>".$mysearch[$i]['telephonenumber'][0]."</td>"; } else { echo "<td></td>"; }
		echo "<td><a href=\"mailto:".$mysearch[$i]['mail'][0]."\">".$mysearch[$i]['mail'][0]."</a></td>";
		if (isset($mysearch[$i]['displayname'][0])) { echo "<td>".$mysearch[$i]['company'][0]."</td>"; } else { echo "<td></td>"; }
		echo "</tr>";
		}
	}

?>
</table>
<?php } ?>