<?php
if (!function_exists('mcrypt_get_iv_size')) {
       header('Location: '.PATH.'install/env-test.php' );       
        }

function encrypttext($input,$cryptkey)
        {
            $td = mcrypt_module_open('des', '', 'ecb', '');
            $key = substr($cryptkey, 0, mcrypt_enc_get_key_size($td));
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
function decrypttext($encrypted,$cryptkey)
        {
            $td = mcrypt_module_open('des', '', 'ecb', '');
            $key = substr($cryptkey, 0, mcrypt_enc_get_key_size($td));
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

?>
