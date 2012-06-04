<?php
require_once 'php/db/db.class.php';
class Chatrooms extends DB{
    function getChatroomList(){
        parent::connect();
        $result = parent::query("SELECT * FROM chatrooms WHERE deleted=0");
        echo '<table>';
        echo '<th>Room name</th><th>Users</th>';
        while ($row = mysql_fetch_assoc($result)) {
            $users = parent::query("SELECT * FROM users Where roomID=" . $row['id']);
            $numOfUsers = mysql_num_rows($users);
            echo '<tr>';
            echo '<td id="chatName">' . $row['name'] . '</td>';
            //echo '<a href="chatroom.php?room_id=' . $row['id'] . '">' . $row['name'] . '</a>' . '&nbsp;&nbsp;&nbsp;&nbsp;Number of users in room: ';
            echo '<td id="numOfUsers">' . $numOfUsers . '</td>';
            echo '<td id="enterChat"><form action="chatroom.php" method="post"> <input type="hidden" name="roomID" value="' . $row['id'] . '"/><input type="submit" value="Enter"/></form></td>';
            echo '</tr>';
        }
        echo '</table>';
    }
    
    function stillExist(){
        @session_start();
        $roomID = $_SESSION['roomID'];
        parent::connect();
        $result = parent::query("SELECT * FROM chatrooms WHERE id='$roomID' AND deleted=0");
        if (mysql_num_rows($result) == 1){
            return true;
        }
        else {
            return false;
        }
    }
    
    function createChatroom($roomName){
        session_start();
        $userID = $_SESSION['userID'];
        parent::connect();
        $result = parent::query("INSERT INTO chatrooms (roomCreatorID, name) VALUES ('$userID', '$roomName')");
        if ($result){
            echo 'Chatroom created successfully!</br>';
        }
    }
    
    function deleteChatroom(){
        parent::connect();
        $roomID = $_SESSION['roomID'];
        $deleted = (int)'1';
        parent::query("UPDATE chatrooms SET deleted='$deleted' WHERE id='$roomID'");
        //parent::query("delete from chatrooms where id='$roomID'");
        Chatrooms::postMessage('The room creator has deleted this chatroom.', $roomID);
    }
    
    function postUserMessage($message){
        session_start();
        $username = $_SESSION['username'];
        $roomID = $_SESSION['roomID'];
        parent::connect();
        parent::query("INSERT INTO chatlog (username, roomID, text) VALUES ('$username', '$roomID' , '$message')");
        
    }
    
    function postMessage($message, $roomID){
        parent::connect();
        $username = "SYSTEM";
        parent::query("INSERT INTO chatlog (username, roomID, text) VALUES ('$username', '$roomID' , '$message')");
        
    }

}

?>