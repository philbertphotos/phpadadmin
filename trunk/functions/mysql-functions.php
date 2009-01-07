<?php
if (!function_exists('mysql_connect')) {
       header('Location: '.PATH.'install/env-test.php' );       
        }
/*############ My SQL Functions  ###############*/

function  _dbconnect() 
        {
        global $db_user;
        global $db_pass;
        global $db_database;
        global $db_host;
        
        $link = mysql_connect($db_host, $db_user, $db_pass);
        if (!$link) { die('Not connected : ' . mysql_error()); }
        $db_selected = mysql_select_db($db_database, $link);
        if (!$db_selected) { die ('Can\'t use '.$db_database.' : ' . mysql_error()); }        
        }

//_dbupdate executes a SQL statement, i.e for UPDATE, DROP etc statements.
function _dbupdate ($sql)
        {
        _dbconnect();
        $result = mysql_query($sql);
        if (!$result) {
            die("\n ".'<br><font color="red"><b>Invalid query:</b></font> ' . mysql_error());
                    }
        mysql_close();
        }

// _dbquery returns an array from a SELECT statement (OLD NON ZEND)    
function _isitindb ($sql)
        {
         // Connect to the database
         _dbconnect();
         $result = mysql_query($sql);
         $num_rows = mysql_num_rows($result);
         if ($num_rows > 0) {
            return true; } else {
            return false;
            }
        
        }

function _dbquery ($sql,$type=MYSQL_ASSOC,$print=false)  // type MYSQL_ASSOC , MYSQL_NUM , MYSQL_BOTH
        {
         global $_GET;  
        _dbconnect();
        $query = mysql_query($sql);
        $i=0;
        if ($print == true)
            {
             echo '<div class=debug>';
             echo '<h5>OUTPUT for '.$sql.'</h5>';   
            }
        while ($results = mysql_fetch_array($query,$type))
            {
            $output[$i]=$results;
            $i++;
            }
        
        if ($print == true)
            {
            echo '<pre>';
            print_r($output);
            echo '</pre>';
            }
        if ($print == true)
            {
             echo '</div>';   
            }        
        if (isset($output)) { return $output; } else { return false; }
        mysql_close();
        }
/*############ End of MYSQL Functions  ###############*/

?>
