<?php
require_once 'php/db/db.class.php';
class Users extends DB{
    function login($username, $password){
        parent::connect();
        $result = parent::query("SELECT * FROM users WHERE username='$username' AND password='$password'");
        $count = mysql_num_rows($result);
        if($count < 1) {
            return false;
        }
        else {
            return true;
        }
    }
    
    function logout($username, $roomID, $text){
        parent::connect();
        parent::query("UPDATE users SET roomID=null WHERE username='$username'");
        if (!is_null($roomID)){
            mysql_query("INSERT INTO chatlog (username, roomID, text) VALUES ('SYSTEM', '$roomID' , '$text')");
        }
    }
    
    function register($username, $password){
        parent::connect();
        return parent::query("INSERT INTO users (username,password) VALUES ('$username', '$password')");        
    }
    
    function getUserID($username){
        $result = parent::query("SELECT * FROM users WHERE username='$username'");
        $row = mysql_fetch_assoc($result);
        return $row['id'];
    }
    
    function setRoomID($roomID){
        $_SESSION['roomID'] = $roomID;
        $username = $_SESSION['username'];
        parent::connect();
        parent::query("UPDATE users SET roomID='$roomID' WHERE username='$username'");
        
    }
    
    function isRoomAdmin(){
        $userID = $_SESSION['userID'];
//        echo 'UserID: ' . $userID;
        $roomID = $_POST['roomID'];
//        echo '</br>roomID: ' . $roomID;
        parent::connect();
        $result = parent::query("SELECT * FROM chatrooms WHERE id='$roomID'");
        $row = mysql_fetch_assoc($result);
        $roomAdmin = $row['roomCreatorID'];
//        echo '</br>Room Admin: ' . $roomAdmin;
        if ($userID == $roomAdmin){
            include 'room_control.php';
        }
        else {
            echo 'Is not room admin';
        }

    }
}
?>
