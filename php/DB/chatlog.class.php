<?php
require_once 'php/db/db.class.php';
class Chatlog extends DB{
    function displayChat(){
        @session_start();
        parent::connect();
        $roomID = $_SESSION['roomID'];
        $result = parent::query("SELECT * FROM chatlog WHERE roomID='$roomID' ORDER BY id DESC LIMIT 10");
        $chatID = 0;
        while ($row = mysql_fetch_assoc($result)) {
            $chatID = $row["id"];
            echo '<dl>';
            echo '<dt><img src="images/icon.png">' . $row["username"] . '</img></dt>';
            echo '<dd>' . $row["text"] . '</dd>';
            echo '</dl>';
        }
        //TODO: Would like to only use 1 query in this function
        //Reason for this is displaying duplicate chat when entering
        $lastID = parent::query("SELECT * FROM chatlog WHERE roomID='$roomID' ORDER BY id DESC LIMIT 1");
        $lastRow = mysql_fetch_assoc($lastID);
        $_SESSION['chatID'] = $lastRow["id"];
    }
    
    function displayNewMessage(){
        @session_start();
        parent::connect();
        $roomID = $_SESSION['roomID'];
        $result = parent::query("SELECT * FROM chatlog WHERE roomID='$roomID' ORDER BY id DESC");
        $row = mysql_fetch_assoc($result);
        if ($_SESSION['chatID']!= $row['id']) {
            $_SESSION['chatID'] = $row['id'];
            echo '<dl>';
            echo '<dt><img src="images/icon.png">' . $row["username"] . '</img></dt>';
            echo '<dd>' . $row["text"] . '</dd>';
            echo '</dl>';
        }
        else {
        }
    }
    
}

?>
