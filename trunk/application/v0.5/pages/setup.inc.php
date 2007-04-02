<h2>Setup</h2>
<?php
if (strtolower($userinfo['username']) == strtolower($phpadadmin->configusername)) { 
?>
<form method="post">
		<div class="tabber" id="tab1">
		 <div class="tabbertab">
		   <h2><a name="tab1">Domains</a></h2>
		   
		   hello domains
		 </div>
	
		 <div class="tabbertab">
		   <h2><a name="tab2">Settings</a></h2>
<table>
	<tr>
		<td>Logging</td>
		<?php
		if ($phpadadmin->logging =="true") { $true='checked="checked"'; } else { $true =''; }
		if ($phpadadmin->logging =="false") { $false='checked="checked"'; } else { $false =''; }
		?>
		<td><input type="radio" name="logging" <?php echo $true ?> value="true"> On
			<input type="radio" name="logging" <?php echo $false ?> value="false"> Off</td>
	</tr>
	<tr>
		<?php
		if ($phpadadmin->ldaps =="true") { $true='checked="checked"'; } else { $true =''; }
		if ($phpadadmin->ldaps =="false") { $false='checked="checked"'; } else { $false =''; }
		?>
		<td>LDAPS</td>
		<td><input type="radio" name="ldaps" <?php echo $true ?> value="true"> Enabled 
			<input type="radio" name="ldaps" <?php echo $false ?> value="false"> Diabled</td>
	</tr>
	<tr>
		<td>Minimum Password Length</td>
		<td><input type="text" name="minpwdlength" value="<?php echo $phpadadmin->minpwdlength ?>"></td>
	</tr>
	<tr>
		<td>Minimum Question Length (Chars)</td>
		<td><input type="text" name="minquestionlength" value="<?php echo $phpadadmin->minquestionlength ?>"></td>
	</tr>
	<tr>
		<td>Minimum Answer Length (Chars)</td>
		<td><input type="text" name="minanswerlength" value="<?php echo $phpadadmin->minanswerlength ?>"></td>
	</tr>
	<tr>
		<td>Minimum number of Questions</td>
		<td><input type="text" name="minnumberofquestions" value="<?php echo $phpadadmin->minnumberofquestions ?>"></td>
	</tr>
	<tr>
		<td>Encryption key</td>
		<td><input type="text" name="encryptionkey" value="<?php echo $phpadadmin->encryptionkey ?>"></td>
	</tr>
	<tr>
		<td>Configuration User</td>
		<td><input type="text" name="configusername" value="<?php echo $phpadadmin->configusername ?>"></td>
	</tr>
	</div>
		
</div>
</form>
<?php
} else {
echo $phpadadmin->configusername."<br>po".$userinfo['username'];
echo "access denied!";
}
?>