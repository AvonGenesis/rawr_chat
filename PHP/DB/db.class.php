<?php
require_once 'PHP/Settings/settings.php';

class DB {
    protected function connect() {
        $connect = mysql_connect(Settings::DB_HOST, Settings::DB_USER, Settings::DB_PASS);
        if (!$connect) {
            echo mysql_error();
            exit();
        }
        
        $DB = mysql_select_db(Settings::DB_NAME);
        if (!$DB) {
            echo mysql_error();
            exit();
        }
        
        return true;
    }    

    
    protected function query($queryString) {
        $result = mysql_query($queryString);
        if (!$result) {
            echo mysql_error();
        }
        else {
            return $result;
        }
    }
}

?>
