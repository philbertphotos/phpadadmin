<html>
<head>
<title>phpADadmin Environment Setup debug</title>
<meta name="author" content="James Lloyd">
<style>
body {
 background: #ccc;
 text-align:center;   
}
#wrapper {
 background: #FFFFFF;
 text-align: left;
 margin-left:auto;
 margin-right:auto;
 width:400px;
 padding:10px;
 
}
.test { 
    padding:3px;
    margin:10px;
    background: #80FF80;   
}
.fail {
    background: #FF8080;
}

</style>
</head>
<body>
<div id="wrapper">
 <div class="test <?php if (!function_exists('mcrypt_get_iv_size')) { $test='Fail'; ?>fail<?php } ?>">
           php mycrypt module =  <?php if (function_exists('mcrypt_get_iv_size')) {?>Success<?php } else { ?>Fail!<?php } ?>
 </div>
 <div class="test <?php if (!function_exists('ldap_connect')) { $test='Fail'; ?>fail<?php } ?>">
           php ldap module =  <?php if (function_exists('ldap_connect')) {?>Success<?php } else { ?>Fail!<?php } ?>
 </div>
  
 

</div>
</body>
</html>