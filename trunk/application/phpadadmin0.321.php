<?php
// 					php-AD-admin
// Filename :		phpadadmin.php
// Date :		04/12/2006
// Version :		0.321
// Author :		James Lloyd
// Email :		help@phpadadmin.com
// www :		www.phpadadmin.com




if (!function_exists('ldap_connect')) {
	die ( " LDAP Module does not appear to be installed edit your php.ini" );
	}
class phpadadmin
{

/*
Start of config

Please note the netbios style domain name should be in upper case

*/
var $logging=false;

var $domainconfig=array("DOMAIN"=>array (	"fqdn"=>"domain.com",
						"readuser" => "ldapreaduser",
						"readuserpassword" => "password",
						"writeuser" => "ldapwriteuser",
						"writeuserpassword" => "password",
						 ),);

	// This is the username of the first user that access the configuration page.
	// once inside the config page you can configure the CN of a group that can access
	// Note:  This username is Case sensitive.  If you unsure the user name is shown as phpadadmin
	//        sees it under My Network Account at the bottom.

	var $configusername="administrator";

	//  No more editing required
	var $domaindn="";
	var $version="0.321";

	// AD Connect
	function adconnect($function,$domain)
		{
			if (array_key_exists($domain,$this->domainconfig)) { if (isset($_GET['debug']) && $_GET['debug'] == "true"){	echo "Domain ".$domain." exists in the configuration<br>"; } } else { echo "<center>Your domain ".$domain." has not been found in the configuration</center>"; exit; }
			$dcip=gethostbyname($this->domainconfig[$domain]['fqdn']);

			$this->ad=ldap_connect("ldap://".$this->domainconfig[$domain]['fqdn'])
				or die ("LDAP Connection has Failed!");
			if (isset($_GET['debug']) && $_GET['debug'] == "true"){	echo "successful ldap connect to ".$this->domainconfig[$domain]['fqdn']."<br>"; }
			ldap_set_option($this->ad, LDAP_OPT_PROTOCOL_VERSION, 3)
				or die ("LDAP Protocol could not be set!");
			ldap_set_option($this->ad, LDAP_OPT_REFERRALS, 0)
				or die ("LDAP Refferealls could not be set!");
			if (isset($_GET['debug']) && $_GET['debug'] == "true"){	echo "successful ldap protocol set<br>"; }
			if ($this->domainconfig[$domain]['readuser']!=NULL && $this->domainconfig[$domain]['readuserpassword']!=NULL){
			if ($function=="r")
					{ $u=$this->domainconfig[$domain]['readuser'] ; $p=$this->domainconfig[$domain]['readuserpassword'];
				} else {
					if ($function=="rw")
						{ $u=$this->domainconfig[$domain]['writeuser'] ; $p=$this->domainconfig[$domain]['writeuserpassword'];
					} else {
					$u="not set";
					$p="not set";
					}
				}
				$u=$u."@".$this->domainconfig[$domain]['fqdn'];

			$bd=ldap_bind($this->ad,$u,$p)
				or die ("LDAP Bind or Authentication Failed!");
			if (isset($_GET['debug']) && $_GET['debug'] == "true"){	echo "successful ldap bind with user ".$u."<br>"; };
			if (!isset($this->domainconfig[$domain]['domaindn'])) // if DN isn't specified guess it from the fqdn
			   {
					$domaindn=explode(".",$this->domainconfig[$domain]['fqdn']);
					$domaindn=implode(",dc=",$domaindn);
					$domaindn="DC=".$domaindn;
					$this->domainconfig[$domain]['domaindn']=$domaindn;
			   }
			}
		}
	function adquery($searchfield,$searchtext,$field,$object,$domain)
		{
			$this->adconnect('r',$domain);
			$filter = "(&(".$searchfield."=".$searchtext.")(objectclass=".$object."))";
			$search = ldap_search($this->ad, $this->domainconfig[$domain]['domaindn'], $filter, $field)
					  or die ("ldap search failed");
			$info = ldap_get_entries($this->ad, $search);
			return($info);
		}
	function adquery2($filter,$field,$domain)
		{
			$this->adconnect('r',$domain);
			$search = ldap_search($this->ad, $this->domainconfig[$domain]['domaindn'], $filter, $field)
					  or die ("ldap search failed");
			$info = ldap_get_entries($this->ad, $search);
			return($info);

		}
	function ldaplist($domaindn,$searchfield,$searchtext,$field,$object,$domain)
		{
			$this->adconnect('r',$domain);
			$filter="(&(".$searchfield."=".$searchtext.")(objectclass=".$object."))";
			$list = ldap_list($this->ad, $domaindn, $filter, $field);
			$info=ldap_get_entries($this->ad,$list);
			return($info);
		}
	function ldaplist2($domaindn,$filter,$field,$domain)
		{
			$this->adconnect('r',$domain);
			$list = ldap_list($this->ad, $domaindn, $filter, $field);
			$info=ldap_get_entries($this->ad,$list);
			return($info);
		}
	function updateaccount2($update,$dn,$domain)
		{
					foreach ($update as $key => $value) 	{
							if (!empty($value)) {
								$updateattr[$key]=$value  ;
								} else {
									if (!empty($_POST["was".$key]))
									{
									$updatedel[$key]=$_POST["was".$key];
									}
								}

							}

			$this->adconnect('rw',$domain);
		if (isset($updatedel)) { ldap_mod_del($this->ad,$dn,$updatedel);}

			ldap_modify($this->ad,$dn,$updateattr);

		}
	function updateaccount($title,$telephonenumber,$mobile,$fax,$department,$company,$dn,$domain)
		{
			$this->adconnect('rw',$domain);
			$update['title']=$title;
			$update['telephonenumber']=$telephonenumber;
			$update['mobile']=$mobile;
			$update['facsimiletelephonenumber']=$fax;
			$update['department']=$department;
			$update['company']=$company;
			ldap_modify($this->ad,$dn,$update);
		}
	function getuser()
		{
			list($domain, $username) = split('[\\]', $_SERVER["LOGON_USER"]);
			$userdetails['username']=$username;
			$userdetails['domain']=strtoupper($domain);
			if (empty($userdetails['username']))
				{ echo "<center><b>Cannot detect your username<br>make sure your windows integrated authentication is enabled<br><img src='images/errors/usererror.jpg'></center>"; exit; }
			return($userdetails);
		}
	function ingroup($samaccountname,$group,$domain) // usage : $group has to be the full DN of the group name.
		{
			$ingroup=$this->adquery("samaccountname",$samaccountname,array("memberof"),"user",$domain);
			$ingroup=array_keys($ingroup[0]['memberof'],$group);
			if (!empty($ingroup[0])) { return true; } else { return false;}
		}
	function creategroup($name,$ou,$domain)
		{
			$availablegroupname=$this->adquery("samaccountname",$name,array("samaccountname"),"*",$domain);
			if ($availablegroupname['count'] > 0) { echo "<br><b>Group Not available</b> (already in use)<br>"; } else {
			$this->adconnect('rw',$domain);
			$dn = "CN=".$name.",".$ou.",".$this->domainconfig[$domain]['domaindn'];
			$creategroup["objectclass"]="group";
			$creategroup["name"]=$name;
			$creategroup["samaccountname"]=$name;
			ldap_add($this->ad, $dn, $creategroup);
			echo "Group ".$name." created<br>";
			}
		}
	function createuser($lastname,$firstname,$displayname,$username,$ou,$enabled,$domain)
		{
			$availableusername=$this->adquery("samaccountname",$username,array("samaccountname"),"*",$domain);
			if ($availableusername['count'] > 0) { echo "<br><b>Username Not available</b> (already in use)<br>"; } else {
			$this->adconnect('rw',$domain);
			$dn = "CN=".$displayname.",".$ou.",".$this->domainconfig[$domain]['domaindn'];
			$createuser["sn"]=$lastname;
			$createuser["givenname"]=$firstname;
			$createuser["displayname"]=$displayname ;
			$createuser["objectclass"]="user";
			$createuser["samaccountname"]=$username;
			ldap_add($this->ad, $dn, $createuser);
			echo "User ".$displayname." created<br>";

			}
		}

	function displaydomains()
			{
			echo "<h4>Domains</h4><ul>";
			foreach( $this->domainconfig as $domainname => $value){
			echo "<li><a href=\"?domain=".$domainname."\">".$domainname."</a> <small><a href=\"?domain=".$domainname."&debug=true\">debug</a></small></li>";
			}

				echo "</ul>";
		}
	function csv2array($filename)
		{
			$row = 0;
			$handle = fopen($filename, "r") or die ('<center><b>could not open '.$filename.'</b></center>');
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			   $num = count($data);
			   $row++;
				   for ($c=0; $c < $num; $c++) {
					   $output[$row][$c]=$data[$c] ;
				   }
			}
			return($output);
		}

	function log()
		{
			$filename = 'logs/'.date('dmy').'.log';
			$somecontent = date("D M j G:i:s T Y").",".$_SERVER['AUTH_USER'].",".$_SERVER['REQUEST_URI']."\n";
			   if (!$handle = fopen($filename, 'a')) {
				 echo "Cannot open file ($filename)";
				 exit;
			   }

			   // Write $somecontent to our opened file.
			   if (fwrite($handle, $somecontent) === FALSE) {
			       echo "Cannot write to file ($filename)";
			       exit;
			   }
			   //echo "Success, wrote ($somecontent) to file ($filename)";
	   		fclose($handle);
		}
	function writefileline($filename,$content)
		{
			   if (!$handle = fopen($filename, 'a+')) {
				 echo "Cannot open file ($filename)";
				 exit;
			   }

			   // Write $somecontent to our opened file.
			   if (fwrite($handle, $content) === FALSE) {
			       echo "Cannot write to file ($filename)";
			       exit;
			   }
			   //echo "Success, wrote ($somecontent) to file ($filename)";
	   		fclose($handle);
		}
	function getconfig($configfile)
		{
		 $output="";
		 $config=$this->csv2array($configfile) or die('cannot open '.$configfile);
		 for ($i=1; $i<count($config)+1; $i++)
		 	{

				  if ($config[$i][0]=="User Edit")
					{
					$output[$config[$i][0]][$config[$i][2]]['name']=$config[$i][1];
					$output[$config[$i][0]][$config[$i][2]]['value']=$config[$i][3];
					if (isset($config[$i][4]))
						{
						$output[$config[$i][0]][$config[$i][2]]['icon']=$config[$i][4];
						}
					$output[$config[$i][0]][$config[$i][2]]['type']=$config[$i][5];
					$output[$config[$i][0]][$config[$i][2]]['display']=$config[$i][6];
					$output[$config[$i][0]][$config[$i][2]]['adattrib']=$config[$i][7];
					$output[$config[$i][0]][$config[$i][2]]['formfield']=$config[$i][8];
					}
				  if ($config[$i][0]=="Function")
					{
					$output[$config[$i][0]][$config[$i][2]]['name']=$config[$i][1];
					$output[$config[$i][0]][$config[$i][2]]['value']=$config[$i][3];
					if (isset($config[$i][4]))
						{
						$output[$config[$i][0]][$config[$i][2]]['icon']=$config[$i][4];
						}
					$output[$config[$i][0]][$config[$i][2]]['type']=$config[$i][5];
					}
				  if ($config[$i][0]=="System")
					{
					$output[$config[$i][0]][$config[$i][2]]['name']=$config[$i][1];
					$output[$config[$i][0]][$config[$i][2]]['value']=$config[$i][3];
					$output[$config[$i][0]][$config[$i][2]]['type']=$config[$i][5];
					}
		   	}
		   return($output);
		 }
	function renderconfig($configarray)
		{
		?><form id="config" name="config" method="post" action="<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'] ?>"><div class="tabber" id="tab1"><?php
		foreach ($configarray as $key => $value)
			{
			?>
			 <div class="tabbertab"><h2><a name="tab1"><?php echo $key ?></a></h2>
			 <?php if ($key =="System" or $key =="Departments") { echo "<b>Doesn't Work yet!</b><br>so dont change in here"; } ?>
			<table>
			 <?php

				foreach ($value as $key => $value2)
				{
				echo "<tr><td>".$value2['name']."</td>";
				?><input name="<?php echo $key ?>-name" type="hidden" value="<?php echo $value2['name'] ?>" /><?php
				if (isset($value2['value']))
						{

						if ($value2['type']=="binary")
							{
							?><input name="<?php echo $key ?>-type" type="hidden" value="binary" /><?php
							if ($value2['value']=="TRUE") { $checked="checked=\"CHECKED\""; $checkedf=" "; } else { $checked=" "; $checkedf="checked=\"CHECKED\""; }
							?>
							<td>
							<label><input type="radio" name="<?php echo $key ?>-value" value="FALSE" <?php echo $checkedf ?>/>Disable</label>
							<label><input type="radio" name="<?php echo $key ?>-value" value="TRUE" <?php echo $checked ?>/>Enable</label>
							</td>
							<?php
							}
						if ($value2['type']=="text")
							{
							?><input name="<?php echo $key ?>-type" type="hidden" value="text" />
							<td>
							<input name="<?php echo $key ?>-value" type="text" value="<?php echo $value2['value'] ?>" />
							</td>
							<?php
							}
						if ($value2['type']=="list")
							{
							?><input name="<?php echo $key ?>-type" type="hidden" value="list" />
							<td>
							<input name="<?php echo $key ?>-delete" type="checkbox" value="yes" /> delete?

							</td>
							<?php
							}
						if ($value2['type']=="domain")
							{
							if ($value[$key]['value']=="TRUE") { $checked="checked=\"CHECKED\""; $checkedf=" "; } else { $checked=" "; $checkedf="checked=\"CHECKED\""; }
							?>
							<td><?php echo $key ?></td><td><?php echo $value[$key]['fqdn'] ?></td><td><?php echo $value[$key]['domaindn'] ?></td><td><?php echo $value[$key]['readuser'] ?></td><td><?php echo $value[$key]['writeuser'] ?></td><td>
							<label><input type="radio" name="<?php echo $key ?>-value" value="FALSE" <?php echo $checkedf ?>/>Disable</label>
							<label><input type="radio" name="<?php echo $key ?>-value" value="TRUE" <?php echo $checked ?>/>Enable</label>
							</td>
							<?php
							}
						}
				if (!empty($value2['icon']))
						{
						?>
						<td>
						<input name="<?php echo $key ?>-icon" type="text" value="<?php echo $value2['icon'] ?>" />
						</td>
						<?php
						}
				echo "</tr>";
				}
			?>
 			</table>
			 </div>
			<?php
			}
		?></div><input type="submit" name="Submit" value="Submit" /></form><?php
		}
	function writeconfig($configfile,$configuration)
		{
				//unlink($configfile);
			foreach ($configuration as $key => $value3)
				{
					foreach ($value3 as $key2 => $value4)
					{
					if (isset($_POST[$key2."-icon"])) { $icon = $_POST[$key2."-icon"]; } else { $icon=""; }
					if (isset($_POST[$key2."-value"])) { $value = $_POST[$key2."-value"]; } else { $value=""; }
					echo $key.",".$value4['name'].",".$key2.",".$value.",".$icon.",".$_POST[$key2."-type"]."<br>";
					$writeline=$key.",".$value4['name'].",".$key2.",".$value.",".$icon.",".$_POST[$key2."-type"]."\n";
					//$this->writefileline($configfile,$writeline);
					}
				}
				?>
				<center><a href="<?php echo $_SERVER['HTTP_REFERER'] ?>">config disbaled as i havnt updated this code yet!</a></center>
				<?php
		}

	}


?>


