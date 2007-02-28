<?php 
include('adduserpage/getuserinfo.php') 
?>
add user
<form name="form1" method="post" action="">
  <table width="100%" border="0" cellspacing="0" cellpadding="3">
    <tr>
      <td>First name </td>
      <td><input type="text" name="textfield"></td>
      <td>Lastname</td>
      <td><input type="text" name="textfield2"></td>
    </tr>
    <tr>
      <td>Display Name </td>
      <td><input type="text" name="textfield3"></td>
      <td>Username </td>
      <td><input type="text" name="textfield4"></td>
    </tr>

    <tr>
      <td colspan="4"><div align="right">
        <input type="submit" name="Submit" value="Create User">
      </div></td>
    </tr>
  </table>
</form>
<form id="finduser" name="finduser" method="post" action="?page=adduser">
  <table width="100%" border="0" cellspacing="0" cellpadding="3">
    <tr>
      </td><td>username 
      <input name="samaccountname" type="text" id="samaccountname" />
      show disabled 
      <input name="disabled" type="checkbox" id="disabled" value="yes" />
      ?  
      </td>
      <td>domain 
      <select name="domain" id="domain">
		<?php
		foreach ($phpadadmin->domainconfig as $key => $value) 	
			{
				echo "<option value=\"".$key."\">".$key."</option>";
			}
		
		?>
      </select>
      <input name="finduser" type="hidden" id="finduser" value="yes" />
      <input type="submit" name="Submit3" value="search" /></td>
    </tr>
  </table>
</form>
<?php
if (isset($_POST['finduser']) && $_POST['finduser'] == "yes" ) 

	{ 
	$findusers=$phpadadmin->adquery2("(&(objectclass=person)(samaccountname=".$_POST['samaccountname']."*))",array("useraccountcontrol","givenname","sn","samaccountname","title"),$_POST['domain']);
   unset($_POST['finduser']);
?>
<table><tr><th>firstname</th><th>lastname</th><th>username</th><th>enable?</th>
<?php
	for ($i=0; $i<$findusers['count']; $i++)
		{
		if ($findusers[$i]['useraccountcontrol'][0] == "514" && !isset($_POST['disabled'])) { } else {
		if (!empty($findusers[$i]['givenname'][0])) { $givenname=$findusers[$i]['givenname'][0]; } else { $givenname=" "; }
		if (!empty($findusers[$i]['sn'][0])) { $sn=$findusers[$i]['sn'][0]; } else { $sn=" "; }
		if ($findusers[$i]['useraccountcontrol'][0] == "514") { $enabled="disabled" ;} else { $enabled="<b>enabled</b>"; }

		echo "<tr><td>".$givenname."</td><td>".$sn."</td><td><a href=\"?page=adduser&user=".$findusers[$i]['samaccountname'][0]."&domain=".$_POST['domain']."\">".$findusers[$i]['samaccountname'][0]."</a></td><td>".$enabled."</td></tr>";
		}
		}
	}
?>



<table width="510" align="center">
<tr><td>
  <form id="userupdate" name="userupdate" method="post" action="?page=adduser-update">
<?php if (isset($_GET['user']) && isset($_GET['domain'])) { ?>
<div class="tabber" id="tab1">

  <div class="tabbertab">

    <h2><a name="tab1">General</a></h2>
	<?php include('adduserpage/general.php') ?>   
  </div>
   <div class="tabbertab">
    <h2>Address</h2>
    <?php include('adduserpage/address.php') ?> 
	</div>
  <div class="tabbertab">
    <h2>Account</h2>
    <?php include('adduserpage/account.php') ?> 
	</div>
  <div class="tabbertab">
    <h2>Profile</h2>
    <?php include('adduserpage/profile.php') ?> 
	</div>
  <div class="tabbertab">
    <h2>Telephones</h2>
    <?php include('adduserpage/telephones.php') ?> 
	</div>
  <div class="tabbertab">
    <h2>Organisation</h2>
    <?php include('adduserpage/organisation.php') ?> 
	</div>
 </div>
    </div>
  </div>
    </form>
<?php } ?>
</td>
</tr>
<pre>

</pre>
</table>

