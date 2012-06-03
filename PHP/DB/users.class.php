<?php
require_once 'PHP/DB/db.class.php';
class Users extends DB{
    function login($username, $password){
        parent::connect();
        $result = parent::query("select * from users where username='$username' and password='$password'");
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
        parent::query("update users set roomID=null where username='$username'");
        if (!is_null($roomID)){
            mysql_query("insert into chatlog (username, roomID, text) values ('$username', '$roomID' , '$text')");
        }
    }
    
    function register($username, $password){
        parent::connect();
        return parent::query("insert into users (username,password) values ('$username', '$password')");        
    }
    
    function getUserID($username){
        $result = parent::query("select * from users where username='$username'");
        $row = mysql_fetch_assoc($result);
        return $row['id'];
    }
    
    function setRoomID($roomID){
        $_SESSION['roomID'] = $roomID;
        $username = $_SESSION['username'];
        parent::connect();
        parent::query("update users set roomID='$roomID' where username='$username'");
        
    }
    
    function isRoomAdmin(){
        $userID = $_SESSION['userID'];
//        echo 'UserID: ' . $userID;
        $roomID = $_POST['roomID'];
//        echo '</br>roomID: ' . $roomID;
        parent::connect();
        $result = parent::query("select * from chatrooms where id='$roomID'");
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
