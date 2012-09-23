<?php
require_once 'php/db/db.class.php';
class Chatrooms extends DB
{
    public static function getChatroomList()
    {
        parent::connect();
        $result = parent::query("SELECT * FROM chatrooms WHERE deleted=0");
        echo '<table class="table table-condensed table-striped">';
        echo '<thead><tr class="row"><th class="span10"><h3>Room name</h3></th><th class="span2"><h3>Users</h3></th></tr></thead><tbody>';
        while ($row = mysql_fetch_assoc($result)) {
            $users = parent::query("SELECT * FROM users WHERE roomID=" . $row['id']);
            $numOfUsers = mysql_num_rows($users);
            echo '<tr class="row">';
            echo '<td class="span10"><h4>' . $row['name'] . '<h4></td>';
            /**
             * echo '<a href="chatroom.php?room_id=' . $row['id'] . '">' . $row['name'] . '</a>' . '&nbsp;&nbsp;&nbsp;&nbsp;Number of users in room: ';
             */
            echo '<td class="span1"><h4>' . $numOfUsers . '</h4></td>';
            echo '<td class="span1"><form action="chatroom.php" method="post"><input type="hidden" name="roomID" value="' . $row['id'] . '"/><input type="submit" id="submit" class="btn btn-primary" value="Enter"/></form></td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    }
    
    public static function stillExist()
    {
        @session_start();
        $roomID = $_SESSION['roomID'];
        parent::connect();
        $result = parent::query("SELECT * FROM chatrooms WHERE id='$roomID'");
        $row = mysql_fetch_assoc($result);
        $deleted = $row['deleted'];
        if ($deleted == 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public static function createChatroom($roomName)
    {
        @session_start();
        $userID = $_SESSION['userID'];
        parent::connect();
        $result = parent::query("INSERT INTO chatrooms (roomCreatorID, name) VALUES ('$userID', '$roomName')");
        if ($result) {
            $query = parent::query("SELECT * FROM chatrooms WHERE name='$roomName'");
            $row = mysql_fetch_assoc($query);
            if (mysql_num_rows($query) == 1) {
                return $row['id'];
            }
        }
    }
    
    public static function deleteChatroom()
    {
        parent::connect();
        $roomID = $_SESSION['roomID'];
        $deleted = (int)'1';
        parent::query("UPDATE chatrooms SET deleted='$deleted' WHERE id='$roomID'");
        /**
         * parent::query("delete from chatrooms where id='$roomID'");
         */
        Chatrooms::postMessage('The room creator has deleted this chatroom.', $roomID);
    }
    
    public static function postUserMessage($message)
    {
        session_start();
        $userID = $_SESSION['userID'];
        $roomID = $_SESSION['roomID'];
        $picture = $_SESSION['picture'];
        $color = $_SESSION['color'];
        $nickname = $_SESSION['nickname'];
        parent::connect();
        parent::query("INSERT INTO chatlog (userID, nickname, roomID, text, picture, color) VALUES ('$userID', '$nickname', '$roomID' , '$message', '$picture', '$color')");
    }
    
    public static function postMessage($message, $roomID)
    {
        parent::connect();
        $nickname = "SYSTEM";
        $userID = "0";
        parent::query("INSERT INTO chatlog (userID, nickname, roomID, text) VALUES ('$userID', '$nickname', '$roomID' , '$message')");
    }
}
?>
