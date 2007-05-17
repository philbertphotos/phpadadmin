<?php
/*############  ENVIRONMENT TEST   ###############*/

// Check the modules are in enabled
if (!function_exists('ldap_connect')) {
	die ( " LDAP Module does not appear to be installed edit your php.ini" );
	}
if (!function_exists('mcrypt_get_iv_size')) {
	die ( " MCRYPT Module does not appear to be loaded edit you php.ini" );
	}

/*############  END  ###############*/
?>