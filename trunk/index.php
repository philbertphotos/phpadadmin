<?php include('includes/ldap-connect.php'); include('includes/getallgroups.php') ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript" src="includes/tabber.js"></script>
<link href="includes/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr class="Header-Text">
    <td><center><strong>php-AD-admin</strong></center></td>
  </tr>
  <tr class="form">
    <td>
<div class="tabber" id="tab1">

  <div class="tabbertab">
    <h2>Users</h2>
			<div class="tabber" id="tab1-1">
			  <div class="tabbertab">
				<h3>Create</h3>
				<?php include('createuser.php'); ?>
			  </div>
			  <div class="tabbertab">
				<h3>Manage</h3>
				<p>TBC</p>
			  </div>
			  <div class="tabbertab">
				<h3>display</h3>
				  <?php include('displayuser.php'); ?>
			  </div>
			  <div class="tabbertab">
				<h3>Update Display Info<a name="userdisplay" id="userdisplay"></a></h3>			  
			  	  <?php include('update.php'); ?>
			  </div>
      </div>
    </div>
  <div class="tabbertab">
    <h2>Groups</h2>
			<div class="tabber" id="tab1-1">
			  <div class="tabbertab">
				<h3>Create</h3>
				<p>TBC</p>
			  </div>
			  <div class="tabbertab">
				<h3>Manage</h3>
				<p>TBC</p>
			  </div>
      </div>
    </div>
  </div>
	</td>
  </tr>
  <tr class="Header-Text">
    <td><center><strong>by <a href="http://www.james-lloyd.com">James Lloyd</a> php-AD-admin <?php echo $versionnumber; ?></strong></center></td>
  </tr>
</table>

</body>
</html>

