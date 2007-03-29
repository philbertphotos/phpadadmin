<?php
// 					php-AD-admin
// Filename :		phpadadmin.php
// Date :		28/03/2006
// Version :		0.5
// Author :		James Lloyd
// Email :		help@phpadadmin.com
// www :		www.phpadadmin.com

//  Check to see if php_ldap module has been enabled

if (!function_exists('ldap_connect')) {
	die ( " LDAP Module does not appear to be installed edit your php.ini" );
	}
class phpadadmin
{
	
//  Configuration starts here

var $logging=false;

//  Required is using the changepassword Function
//  You must be able to connect to Active Directory by LDAPS ( secure ldap ) 
//  In order to change password.

var $ldaps=true;  
var $minpwdlength=7;

// Domain Configuration

var $domainconfig=array("DOMAIN"=>array (	"fqdn"=>"domain.com",

						"readuser" => "ldapreaduser",
						"readuserpassword" => "password",
						"writeuser" => "ldapwriteuser",
						"writeuserpassword" => "password",
						
						 ),);

//  No more editing required
var $domaindn="";
var $version="0.5";

	// AD Connect
	// $function ( either rw or r )
	//	Determines which user to bind to active directory with
	// $domain specifies which domain to connect to ( the Netbios name )
	//	$domain can be determined with getuser()
	//	$userinfo=$phpadadmin->getuser()
	//	$userdomain=$userinfo['domain'];
	//	echo $userdomain;
	function adconnect($function,$domain)
		{
			if (array_key_exists($domain,$this->domainconfig)) { if (isset($_GET['debug']) && $_GET['debug'] == "true"){	echo "Domain ".$domain." exists in the configuration<br>"; } } else { echo "<center>Your domain ".$domain." has not been found in the configuration</center>"; exit; }
			$dcip=gethostbyname($this->domainconfig[$domain]['fqdn']);
			if ( $this->ldaps == true )
				{ 
					$proto = "ldaps"; 
					if (isset($_GET['debug']) && $_GET['debug'] == "true"){	echo "LDAPS (port 636) selected<br>"; }
				} else {
					$proto = "ldap";
					if (isset($_GET['debug']) && $_GET['debug'] == "true"){	echo "LDAP (port 389) selected<br>"; }
				}
			if (isset($this->domainconfig[$domain]['dc'])) // If the A DC is specified use that else use DNS to lookup 
				{
					$this->ad=ldap_connect($proto."://".$this->domainconfig[$domain]['dc'])
						or die ($proto." Connection has Failed!");
						if (isset($_GET['debug']) && $_GET['debug'] == "true"){	echo "Using DC address of ".$this->domainconfig[$domain]['dc']."<br>"; }
				} else {
					$this->ad=ldap_connect($proto."://".$this->domainconfig[$domain]['fqdn'])
						or die ($proto." Connection has Failed!");
						if (isset($_GET['debug']) && $_GET['debug'] == "true"){	echo "No DC specified looking up DC ip for ".$this->domainconfig[$domain]['fqdn']."<br>"; }
				}
			if (isset($_GET['debug']) && $_GET['debug'] == "true"){	echo "successful ".$proto." connect to ".$this->domainconfig[$domain]['fqdn']."<br>"; }
			ldap_set_option($this->ad, LDAP_OPT_PROTOCOL_VERSION, 3)
				or die ($proto." Protocol could not be set!");
			ldap_set_option($this->ad, LDAP_OPT_REFERRALS, 0)
				or die ($proto." Refferealls could not be set!");
			//ldap_start_tls($this->ad);

			if (isset($_GET['debug']) && $_GET['debug'] == "true"){	echo "successful ".$proto." protocol set<br>"; }
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
				$u=$u."@".$this->domainconfig[$domain]['fqdn']; // change username to username@domain format

			$bd=ldap_bind($this->ad,$u,$p)
				or die ("LDAP Bind or Authentication Failed!");
			if (isset($_GET['debug']) && $_GET['debug'] == "true"){	echo "successful ldap bind with user ".$u."<br>"; };
			if (!isset($this->domainconfig[$domain]['domaindn'])) // if DN isn't specified guess it from the fqdn ( DN is user by query functions )
			   {
					$domaindn=explode(".",$this->domainconfig[$domain]['fqdn']);
					$domaindn=implode(",dc=",$domaindn);
					$domaindn="DC=".$domaindn;
					$this->domainconfig[$domain]['domaindn']=$domaindn;
			   }
			}
			if (isset($_GET['debug']) && $_GET['debug'] == "true")
			{
			echo "<br />Ldap error = " . ldap_errno ($this->ad) . ":  " . ldap_error ($this->ad);
			}
		}
	
	// adquery
	// Perform a search on ad with a single filter
	// i.e. search for a username called bob
	// $searchfield = samaccountname
	// $searchtext = bob
	// $field is the array of fields you wish to return
	// i.e. array("mail","samaccountname","sn","givenname")
	// $domain is the netbios name of the domain you wish to query
	function adquery($searchfield,$searchtext,$field,$object,$domain)
		{
			$this->adconnect('r',$domain);
			$filter = "(&(".$searchfield."=".$searchtext.")(objectclass=".$object."))";
			$search = ldap_search($this->ad, $this->domainconfig[$domain]['domaindn'], $filter, $field)
					  or die ("ldap search failed");
			$info = ldap_get_entries($this->ad, $search);
			return($info);
		}
	
	// adquery2
	// Perform a query against the AD 
	// $filter is in the LDAP format 
	// i.e.  (sammacountname=username)  or (&(mail="james.lloyd@phpadadmin.com")(objectClass="person"))
	// $field is the array of fields you wish to return
	// i.e. array("mail","samaccountname","sn","givenname")
	// $domain is the netbios name of the domain you wish to query
	function adquery2($filter,$field,$domain)
		{
			$this->adconnect('r',$domain);
			$search = ldap_search($this->ad, $this->domainconfig[$domain]['domaindn'], $filter, $field)
					  or die ("ldap search failed");
			$info = ldap_get_entries($this->ad, $search);
			return($info);

		}
	
	// ldaplist
	// lists objects in an OU or CN 
	// doesnt recursively go down the tree
	function ldaplist($domaindn,$searchfield,$searchtext,$field,$object,$domain)
		{
			$this->adconnect('r',$domain);
			$filter="(&(".$searchfield."=".$searchtext.")(objectclass=".$object."))";
			$list = ldap_list($this->ad, $domaindn, $filter, $field);
			$info=ldap_get_entries($this->ad,$list);
			return($info);
		}
	
	//  ldaplist2
	// lists objects in an OU or CN 
	// doesnt recursively go down the tree
	function ldaplist2($domaindn,$filter,$field,$domain)
		{
			$this->adconnect('r',$domain);
			$list = ldap_list($this->ad, $domaindn, $filter, $field);
			$info=ldap_get_entries($this->ad,$list);
			return($info);
		}
	
	// changepassword
	// will change the password of the user specified by $userdn
	// note: this requires secure ldap to be enabled on the domain controller
	function changepassword($userdn,$newPassword,$domain)
		{ 
		if (empty($newPassword))
			{
				exit("Blank Password Not Allowed");
			}
		if (strlen($newPassword) < $this->minpwdlength)
			{
				exit("Password Too Short");				
			}
			$this->adconnect('rw',$domain);

			$unipass="\"\x00";
			$i=0;
			while ($i < strlen($newPassword)):
			$unipass = $unipass . $newPassword{$i} . "\x00";
			$i++;
			endwhile;
			$unipass= $unipass . "\"\x00";

		      $userdata["unicodePwd"] = $unipass;  
		      $result = ldap_mod_replace($this->ad,$userdn,$userdata);  
		      if ($result) echo "Password Successfully Changed!" ;  
     		      else echo "There was a problem!";  
		}
		
	// updateaccount2
	// will update any field you present within the array $update
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
		
	// updateaccount
	// will update the fields title, telephonenumber, mobile, fax, department, company
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
		
	// getuser
	// Obtain user info from seemless authentication, this will return domain and username (samaccountname)
	//	$userinfo=$phpadadmin->getuser()
	//	$userdomain=$userinfo['domain'];
	//	$username=$userinfo['username'];
	//	echo $userdomain; // will echo the domain that the user is logged on to
	//	echo $username; // will echo the username that the users is logged on as
	function getuser()
		{
			list($domain, $username) = split('[\\]', $_SERVER["LOGON_USER"]);
			$userdetails['username']=$username;
			$userdetails['domain']=strtoupper($domain);
			if (empty($userdetails['username']))
				{ echo "<center><b>Cannot detect your username<br>make sure your windows integrated authentication is enabled<br><img src='images/errors/usererror.jpg'></center>"; exit; }
			return($userdetails);
		}
	
	// ingroup
	// is user ($sammaccountname) in group ($group) which is in the domain ($domain)
	// returns true is user is found to be in that group
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
	
	//createuser
	//create a user with the minimum attributes set
	//note user is created in the OU $ou and is disbaled by default
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

	//displaydomains
	//produces list of domains in config ( of little use )
	function displaydomains()
			{
			echo "<h4>Domains</h4><ul>";
			foreach( $this->domainconfig as $domainname => $value){
			echo "<li><a href=\"?domain=".$domainname."\">".$domainname."</a> <small><a href=\"?domain=".$domainname."&debug=true\">debug</a></small></li>";
			}

				echo "</ul>";
		}
		
	//csv2array
	//turns a csv file into an array
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
	
	// log 
	// limited log functionaility
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
	// writefilename
	// writes a line of content ($content) to a file ($filename)
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
		
	// getconfig
	// reads in the config from a configfile ( 
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
	}


?>


