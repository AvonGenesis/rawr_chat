<?php
require_once 'php/db.php';
class DB
{
    protected static function connect()
    {
        //$connect = mysql_connect(Settings::DB_HOST, Settings::DB_USER, Settings::DB_PASS);
        $mysqli = new mysqli(Settings::DB_HOST, Settings::DB_USER, Settings::DB_PASS, Settings::DB_NAME);
        if ($mysqli->connect_errno) {
            die('Connect Error: ' . $mysqli->connect_errno);
        }
        return true;
    }
    
    protected static function query($queryString)
    {
        $mysqli = new mysqli(Settings::DB_HOST, Settings::DB_USER, Settings::DB_PASS, Settings::DB_NAME);
        if ($mysqli->connect_errno) {
            die('Connect Error: ' . $mysqli->connect_errno);
        }
        $result = $mysqli->query($queryString);
        if ($result) {
            return $result;
        }
        else {
            die('Query Error: ' . $mysqli->error);
        }
        
    }
}
?>
