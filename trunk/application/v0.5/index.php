<?php
include('classes/phpadadmin0.5.php');
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

<div id="menu">
<h2>
<?php 
if (isset($_GET['ssrp'])) 
	{ 
		echo "Self Service Password Reset" ;
	} else {
		echo $mynetworkdetails[0]['givenname'][0]." ".$mynetworkdetails[0]['sn'][0]; 
	}
?>
</h2>
<ul>
<?php
if (isset($_GET['ssrp'])) 
	{
	?><li><a href="?page=changemypassword&ssrp"><img class="valign" border=0 src="images/icons/<?php echo $config['Function']['changemypassword']['icon'] ?>" width="16" height="16" />&nbsp;<?php echo $config['Function']['changemypassword']['name'] ?></a></li>
		 <?php
	} else {
	foreach ($config['Function'] as $key => $value)
		{
		
		if ($value['value']=="TRUE")
			{
			?><li><a href="?page=<?php echo $key ?>"><img class="valign" border=0 src="images/icons/<?php echo $value['icon'] ?>" width="16" height="16" />&nbsp;<?php echo $value['name'] ?></a></li>
		 <?php
			}
		}
	}
	?>
	</ul>
<h2>Administration</h2>

  </div>

<div id="menu-bottom"></div>
</div>
<div id="middlebox">
 <table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
	<tr>
      <td>
			<?php
			if (empty($_GET['page'])){ include('pages/welcome.inc.php');} else {
					switch ($_GET['page']) {
					case "mynetworkaccount": include("pages/".$_GET['page'].".inc.php");  break;
					case "mygroups": include("pages/".$_GET['page'].".inc.php"); break;
					case "myexchange": include("pages/".$_GET['page'].".inc.php"); break;
					case "mymanager": include("pages/".$_GET['page'].".inc.php"); break;
					case "myfolders": include("pages/".$_GET['page'].".inc.php"); break;
					case "searchdirectory": include("pages/".$_GET['page'].".inc.php"); break;
					case "config": include("pages/".$_GET['page'].".inc.php"); break;
					case "adduser": include("pages/".$_GET['page'].".inc.php"); break;
					case "help": include("pages/".$_GET['page'].".inc.php"); break;
					case "setup": include("pages/".$_GET['page'].".inc.php"); break;
					case "changemypassword": include("pages/".$_GET['page'].".inc.php"); break;
					case "mysecurityquestions": include("pages/".$_GET['page'].".inc.php"); break;
				 	case "userinfo-update": include('execute/userinfo-update.php'); break;
					case "config-update": include('execute/config-update.php'); break;
					case "adduser-update": include('execute/adduser-update.php'); break;
					case "rag": include('pages/rag.php'); break;
					default: include("pages/welcome.inc.php"); break;

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