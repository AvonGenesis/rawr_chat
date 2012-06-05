<?php
require_once 'php/settings/settings.php';

class DB {
    protected function connect() {
        $connect = mysql_connect(Settings::DB_HOST, Settings::DB_USER, Settings::DB_PASS);
        if (!$connect) {
            //echo 'Error #' . mysql_errno() . ':' . mysql_error();
            //exit();
        }
        
        $DB = mysql_select_db(Settings::DB_NAME);
        if (!$DB) {
            //echo 'Error #' . mysql_errno() . ':' . mysql_error();
            //exit();
        }
        
        return true;
    }    

    
    protected function query($queryString) {
        $result = mysql_query($queryString);
        if (!$result) {
            //echo 'Error #' . mysql_errno() . ':' . mysql_error();
            //exit();
        }
        else {
            return $result;
        }
    }
}

?>
