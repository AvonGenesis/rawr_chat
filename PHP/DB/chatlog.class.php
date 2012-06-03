<?php
require_once 'PHP/DB/db.class.php';
class Chatlog extends DB{
    function displayChat(){
        @session_start();
        parent::connect();
        $roomID = $_SESSION['roomID'];
        $result = parent::query("SELECT * FROM chatlog WHERE roomID='$roomID' ORDER BY id DESC");
        while ($row = mysql_fetch_assoc($result)) {
            echo $row["username"] . ': ';
            echo $row["text"];
            echo '</br>';
        }
    }
    
}

?>
