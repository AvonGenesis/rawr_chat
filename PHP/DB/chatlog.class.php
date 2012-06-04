<?php
require_once 'PHP/DB/db.class.php';
class Chatlog extends DB{
    function displayChat(){
        @session_start();
        parent::connect();
        $roomID = $_SESSION['roomID'];
        $result = parent::query("SELECT * FROM chatlog WHERE roomID='$roomID' ORDER BY id DESC");
        $i = 0;
        while ($row = mysql_fetch_assoc($result)) {
            $_SESSION['messageID'] = $row['id'];
            echo '<dl>';
            echo '<dt><img src="images/icon.png">' . $row["username"] . '</img></dt>';
            echo '<dd>' . $row["text"] . '</dd>';
            echo '</dl>';
            $i++;
            if ($i == 10){
                break;
            }
        }
    }
    
    function displayNewMessage(){
        @session_start();
        parent::connect();
        $roomID = $_SESSION['roomID'];
        $result = parent::query("SELECT * FROM chatlog WHERE roomID='$roomID' ORDER BY id DESC");
        $messageID = $_SESSION['messageID'];
        $row = mysql_fetch_assoc($result);
        
        if ($messageID != $row['id']) {
            echo '<dl>';
            echo '<dt><img src="images/icon.png">' . $row["username"] . '</img></dt>';
            echo '<dd>' . $row["text"] . '</dd>';
            echo '</dl>';
            $_SESSION['messageID'] = $row['id'];
        }
        else {
        }
    }
    
}

?>
