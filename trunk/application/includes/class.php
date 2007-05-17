<?php
include('environmenttest.php');
/*############  START CLASS  ###############*/
class phpadadmin {
/*################################################# */
/*################--       EDIT HERE          --################## */
var $dbconnect = 	array(	"host" => 		"localhost",
						"dbname" => 	"phpadadmin06",
						"dbuname" => 	"phpadadmin",
						"dbpword" => 	"password"
						);
/*################--     STOP EDITING       --################## */
/*################################################# */

var $adpasswordkey="adpasswordobscure";

/*############ MYSQL   ###############*/

	function  db_connect() 
		{
			$link = mysql_connect($this->dbconnect['host'], $this->dbconnect['dbuname'], $this->dbconnect['dbpword']);
				if (!$link) 
					{ 
						die('Not connected : ' . mysql_error()); 
					}
			$db_selected = mysql_select_db($this->dbconnect['dbname'], $link);
				if (!$db_selected) 
					{ 
						die ('Can\'t use '.$this->dbconnect['dbname'].' : ' . mysql_error()); 
					}		
		}
	function db_update($sql)
		{
			$this->db_connect();
			mysql_query($sql) or die(' could not perform "'.$sql.'" ');
		}
	function db_query($sql,$format="both") // output a mysql query to an array format ( Numbered Names or Both)
		{
			$this->db_connect();
			$result = mysql_query($sql);
			$output = array();
			$c=0;
				while($results = mysql_fetch_array($result))
					{
						$i=0;
						$fieldcount=count($results)/2;
						if ($format == "both")
							{
								$output[$c]=$results;
							}
						if ($format == "numbered")
							{
							for ($i=0; $i < count($results)/2; $i=$i+1) 
								{	
								$output[$c][$i]=$results[$i];
								}
							}
						if ($format == "names") // doesnt work need to isolate named array values
							{
							for ($i=1; $i < count($results)/2; $i=$i+1) 
								{	
								foreach ($results as $key => $value)
									{
										$output[$c][$key]=$results[$i];
									}
								}					
							}				
				
						$c++;
					}
			return($output);
			
		}
		
/*############  END of MYSQL   ###############*/

/*############  AUTH   ###############*/

	function auth_getuser()
		{
			//User Impersonation
			if (isset($_GET['u']) && isset($_GET['d']))
				{
			$filter = "(samaccountname=".$_GET['u'].")";
			$field = array("sammacountname");
			$findimpersonation=$this->ad_query($filter,$field,$_GET['d']);
			if ($findimpersonation['count'] =="0")
				{
				die("could'nt find the user");
				}
			$username=$_GET['u'];
			$domain=$_GET['d'];
			$userdetails['username']=$username;
			$userdetails['domain']=strtoupper($domain);	
				} else {
			// Strip Domain and Username from Header
			list($domain, $username) = split('[\\]', $_SERVER["LOGON_USER"]);
			$userdetails['username']=$username;
			$userdetails['domain']=strtoupper($domain);
				}
			if (empty($userdetails['username']))
				{ echo "<center><b>Cannot detect your username<br>make sure your windows integrated authentication is enabled<br><img src='images/errors/usererror.jpg'></center>"; exit; }
			$sql="SELECT `value` FROM `domainconfig` WHERE `netbiosname` = '".$userdetails['domain']."' AND `name` = 'fqdn'";	
		// Find FQDN from matching netbios domain in db with config
			$fqdn=$this->db_query($sql);
		// Build Userprincipal name using username@fqdn
			$userdetails['userprincipalname']=strtolower($username."@".$fqdn[0]['value']);	
		//if user doesnt already exist in db, create it
			$sql = 'SELECT `index` ,`samaccountname` FROM `users` WHERE `samaccountname` = \''.$userdetails['userprincipalname'].'\'  ';
			//$sql="SELECT `samaccountname` FROM `users` WHERE `samaccountname` = '".$userdetails['userprincicalname']."'";
			$createuser=$this->db_query($sql);
			if (count($createuser)==0)
				{
			//user does not exist yet lets add it
				echo "didnt exist<br>";
				$sql = 'INSERT INTO `users` (`index`, `samaccountname`, `lastseen`, `lastseenat`, `created`, `admin`) VALUES (NULL, \''.$userdetails['userprincipalname'].'\', NOW(), \''.$_SERVER[REMOTE_ADDR].'\', NOW(), NULL);';
				$this->db_update($sql);
				echo "added<br>";
				} else {
			//set users db id in $userdetails
				$userdetails['userid']=$createuser[0]['index'];
			//user already exists just update the last seen
				$sql = 'UPDATE `users` SET `lastseen` = NOW(), `lastseenat` = \''.$_SERVER[REMOTE_ADDR].'\' WHERE `users`.`index` = '.$userdetails['userid'].' LIMIT 1;';
				$this->db_update($sql);
				}
			// Add some details from AD its self (i.e. firstname lastname etc) for greeting and stuff
			$filter = "(samaccountname=".$userdetails['username'].")";
			$field = array("givenname","sn","telephonenumber");
			$adsearch=$this->ad_query($filter,$field,$userdetails['domain']);
			for ($i=0; $i < count($field); $i++)
				{
					$userdetails[$field[$i]]=$adsearch[0][$field[$i]][0];
				}
			
			return($userdetails);
		}
		
/*############  END  of AUTH ###############*/

/*############  Encyption   ###############*/

//encrypt text using the key in the domain config, default to the current users domain
function crypt_en($input,$domain)
	{
		$sql = 'SELECT `value` FROM `domainconfig` WHERE `netbiosname` = \''.$domain.'\' AND `name` = \'encryptionkey\'';
		$encryptionkey=$this->db_query($sql,"numbered");
		$encryptionkey=$encryptionkey[0][0];
		
		$td = mcrypt_module_open('des', '', 'ecb', '');
		$key = substr($encryptionkey, 0, mcrypt_enc_get_key_size($td));
		$iv_size = mcrypt_enc_get_iv_size($td);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		
		 if (mcrypt_generic_init($td, $key, $iv) != -1) 
			{
				/* Encrypt data */
				$encrypted = mcrypt_generic($td, $input);
				mcrypt_generic_deinit($td);
				mcrypt_module_close($td);
			}
		
		
		return($encrypted);
	}
//decrypt text using the key in the domain config, default to the current users domain
function crypt_de($encrypted,$domain)
	{
		$sql = 'SELECT `value` FROM `domainconfig` WHERE `netbiosname` = \''.$domain.'\' AND `name` = \'encryptionkey\'';
		$encryptionkey=$this->db_query($sql,"numbered");
		$encryptionkey=$encryptionkey[0][0];
		$td = mcrypt_module_open('des', '', 'ecb', '');
		$key = substr($encryptionkey, 0, mcrypt_enc_get_key_size($td));
		$iv_size = mcrypt_enc_get_iv_size($td);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		
		 if (mcrypt_generic_init($td, $key, $iv) != -1) 
			{
				/* Reinitialize buffers for decryption */
				mcrypt_generic_init($td, $key, $iv);
				$decrypted = mdecrypt_generic($td, $encrypted);
				mcrypt_generic_deinit($td);
				mcrypt_module_close($td);
			}
		
		
		return($decrypted);		
	}

/*############  END of ENCRYPTION   ###############*/

/*############  ACITVE DIRECTORY   ###############*/
function ad_domainconfig($domain)
	{
	//first find all domain config fields
	$sql = 'SELECT distinct `name` FROM `domainconfig` ';
	$configitems=$this->db_query($sql,"numbered");	
	//go through all fields and assign them in $domainconfig
	for ($i=0;  $i<count($configitems); $i++)
		{
		
		$sql = 'SELECT `value` FROM `domainconfig` WHERE `netbiosname` = "'.$domain.'" AND `name` = "'.$configitems[$i][0].'"';
		$config=$this->db_query($sql,"numbered");
		
		$domainconfig[$configitems[$i][0]]=$config[0][0];
		}
	if (!isset($domainconfig['domaindn'])) // if DN isn't specified guess it from the fqdn ( DN is user by query functions )
		   {
				$domaindn=explode(".",$domainconfig['fqdn']);
				$domaindn=implode(",dc=",$domaindn);
				$domaindn="DC=".$domaindn;
				$domainconfig['domaindn']=$domaindn;
		   }
		return($domainconfig);
	}
		
function ad_connect($domain,$function="readonly")
	{
	$domainconfig=$this->ad_domainconfig($domain);
	$this->ad=ldap_connect("ldaps://".$domainconfig[$domain]['dcip']);
			ldap_set_option($this->ad, LDAP_OPT_PROTOCOL_VERSION, 3)
				or die ($proto." Protocol could not be set!");
			ldap_set_option($this->ad, LDAP_OPT_REFERRALS, 0)
				or die ($proto." Refferealls could not be set!");
				if ($function=="readonly")
					{ 
					$u=$domainconfig['readuser'] ; 
					$p=$domainconfig['readuserpassword'];
					} else {
					if ($function=="readwrite")
						{ 
						$u=$domainconfig['writeuser'] ; 
						$p=$domainconfig['writeuserpassword'];
						} else {
						$u="not set";
						$p="not set";
					}
				}
		$u=$u."@".$domainconfig['fqdn']; // change username to username@domain format
		$bd=ldap_bind($this->ad,$u,$p)
			or die ("LDAP Bind or Authentication Failed!");
	}
	function ad_query($filter,$field,$domain)
		{
			$domainconfig=$this->ad_domainconfig($domain);
			$this->ad_connect($domain);
			$search = ldap_search($this->ad, $domainconfig['domaindn'], $filter, $field)
					  or die ("ldap search failed");
			$info = ldap_get_entries($this->ad, $search);
			return($info);
		}
	
/*############  END of ACTIVE DIRECTORY   ###############*/

/*############  MISC   ###############*/
	function misc_array2table($array)
		{
		//Display an Array in a table ( just a quick thing for debugging)
		?><table border="1">
			
			<tr>
				<th>Key</th>
				<th>value</th>
			</tr><?php
		foreach ($array as $key => $value) 
			{
				echo"<tr><td>".$key."</td><td>".$value."</td></tr>";
			}
			echo"</table>"	;
		
		}
/*############  END OF MISC   ###############*/

/*############  END OF CLASS   ###############*/
	}

?>