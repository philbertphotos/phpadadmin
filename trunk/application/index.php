<?php
include('phpadadmin0.321.php');
$timeStart=gettimeofday();
$timeStart_uS=$timeStart["usec"];
$timeStart_S=$timeStart["sec"];
$phpadadmin=new phpadadmin;
if ($phpadadmin->logging = true) { $phpadadmin->log(); }
$userinfo=$phpadadmin->getuser();
$configfile='config/config.csv';
$config=$phpadadmin->getconfig($configfile);

//get my network details feild from csv
$c=0;
foreach ($config['User Edit'] as $key => $value)
	{
	$fields[$c]=$value['adattrib'];
	$c=$c+1;
	}
	$fields[$c]="memberof";$c=$c+1;
	$fields[$c]="mail";$c=$c+1;
	$fields[$c]="givenname";$c=$c+1;
	$fields[$c]="sn";$c=$c+1;
	$fields[$c]="samaccountname";$c=$c+1;
	$fields[$c]="description";$c=$c+1;
	$fields[$c]="directreport";$c=$c+1;



$mynetworkdetails=$phpadadmin->adquery("samaccountname",$userinfo['username'],$fields,"user",$userinfo['domain']) ;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<meta name="AUTHOR" CONTENT="James Lloyd www.james-lloyd.com">
<meta name="ROBOTS" CONTENT="NONE"> 
<meta name="generator" content="php-AD-admin <?php echo $phpadadmin->version; ?> www.phpadadmin.com" />
<title>php-AD-admin</title>

<link href="Style/style320.css" rel="stylesheet" type="text/css" />
<link href="Style/tabber.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/tabber.js">
</script>
</head>

<body>
<div id="banner"><a href="index.php"><img  border="0" src="images/logo2.gif" width="179" height="36" /></a></div>
<div id="topmenu"><div id="topmenu-block-help">
<table>
<tr valign="middle">
<td><img src="images/icons/help.gif" width="16" height="16" />
</tr></table>
</div>
<div id="topmenu-block"></div>

</div>
<div id="leftbox">
<div id="menu-top"></div>
  <ul>
    <li>
      &nbsp;<?php echo $mynetworkdetails[0]['givenname'][0]." ".$mynetworkdetails[0]['sn'][0]; ?></li>
  </ul>
<div id="menu">

<table width="100%" border="0" cellspacing="0" cellpadding="2">
<?php
foreach ($config['Function'] as $key => $value)
	{
	if ($value['value']=="TRUE")
		{
		?><tr><td valign="middle"><div align="right"><img src="images/icons/<?php echo $value['icon'] ?>" width="16" height="16" /></div></td>
	 <td>&nbsp;<a href="?page=<?php echo $key ?>"><?php echo $value['name'] ?></a></td></tr>
	 <?php
		}
	}

	?>
</table>




  </div>
<div id="menu-bottom"></div>
</div>
<div id="middlebox">
 <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
	<tr>
      <td>
			<?php
			if (empty($_GET['page'])){ include('pages/mynetworkaccount.inc.php');} else {
					switch ($_GET['page']) {
					case "mynetworkaccount": include("pages/".$_GET['page'].".inc.php"); $pagetitle="Network Account"; break;
					case "mygroups": include("pages/".$_GET['page'].".inc.php"); $pagetitle="Groups";break;
					case "myexchange": include("pages/".$_GET['page'].".inc.php"); $pagetitle="Exchange";break;
					case "mymanager": include("pages/".$_GET['page'].".inc.php"); $pagetitle="Manager";break;
					case "myfolders": include("pages/".$_GET['page'].".inc.php"); $pagetitle="Folders";break;
					case "mysearch": include("pages/".$_GET['page'].".inc.php"); $pagetitle="Search";break;
					case "config": include("pages/".$_GET['page'].".inc.php"); $pagetitle="config";break;
					case "adduser": include("pages/".$_GET['page'].".inc.php"); $pagetitle="adduser";break;
					case "help": include("pages/".$_GET['page'].".inc.php"); $pagetitle="Help";break;
				 	case "userinfo-update": include('execute/userinfo-update.php'); break;
					case "config-update": include('execute/config-update.php'); break;
					case "adduser-update": include('execute/adduser-update.php'); break;
					default: include("pages/mynetworkaccount.inc.php"); $pagetitle="Network Account";break;

					}
				}
			?>
	  </td>
    </tr>
  </table>
  <div id="footer">
  <a href="http://www.phpadadmin.com"  target="_blank">php-AD-admin</a> Version <?php echo $phpadadmin->version; ?><br />
<?php
$timeEnd=gettimeofday();
$timeEnd_uS=$timeEnd["usec"];
$timeEnd_S=$timeEnd["sec"];
$ExecTime_S=($timeEnd_S+($timeEnd_uS/1000000))-($timeStart_S+($timeStart_uS/1000000));
echo "This page took ".round($ExecTime_S,2)." seconds to render";?></div>
</div>

</body>
</html>
<?php ldap_unbind($phpadadmin->ad); ?>