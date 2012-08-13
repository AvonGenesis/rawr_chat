<?php
require_once 'php/db/db.class.php';
class Users extends DB
{
    public static function login($username, $password)
    {
        parent::connect();
        $result = parent::query("SELECT * FROM users WHERE username='$username' AND password='$password'");
        $count = mysql_num_rows($result);
        if($count < 1) {
            return false;
        } else {
            $row = mysql_fetch_assoc($result);
            $_SESSION['picture'] = $row[picture];
            return true;
        }
    }
    
    public static function logout($username, $roomID, $text)
    {
        parent::connect();
        parent::query("UPDATE users SET roomID=null WHERE username='$username'");
        if (!is_null($roomID)) {
            mysql_query("INSERT INTO chatlog (username, roomID, text) VALUES ('SYSTEM', '$roomID' , '$text')");
        }
    }
    
    public static function register($username, $password, $picture)
    {
        parent::connect();
        return parent::query("INSERT INTO users (username,password,picture) VALUES ('$username', '$password', '$picture')");        
    }
    
    public static function changePassword($username, $currentPassword, $newPassword1, $newPassword2)
    {
        $incorrectPassword = '<div class="container alert alert-error fade in">
            <button class="close" data-dismiss="alert">×</button>
            That password you entered is incorrect.
            </div>';
        
        $passwordDoNotMatch = '<div class="container alert alert-error fade in">
            <button class="close" data-dismiss="alert">×</button>
            Passwords do not match!
            </div>';
        
        $successful = '<div class="container alert alert-success fade in">
            <button class="close" data-dismiss="alert">×</button>
            Password changed successfully.
            </div>';
        
        if ($newPassword1 != $newPassword2) {
            return $passwordDoNotMatch;
        }
        
        $currentPassword = md5($currentPassword);
        parent::connect();
        $result = parent::query("SELECT * FROM users WHERE username='$username'");
        $row = mysql_fetch_assoc($result);
        
        if ($row['password'] != $currentPassword){
            return $incorrectPassword;
        }
        
        $newPassword1 = md5($newPassword1);
        $changePassword = parent::query("UPDATE users SET password='$newPassword1' WHERE username='$username'");
        
        if ($changePassword) {
            return $successful;
        }
    }
    
    public static function getUserID($username)
    {
        parent::connect();
        $result = parent::query("SELECT * FROM users WHERE username='$username'");
        $row = mysql_fetch_assoc($result);
        return $row['id'];
    }
    
    public static function getUserColor($username)
    {
        parent::connect();
        $result = parent::query("SELECT * FROM users WHERE username='$username'");
        $row = mysql_fetch_assoc($result);
        return $row['color'];
    }
    public static function setRoomID($roomID)
    {
        @session_start();
        $_SESSION['roomID'] = $roomID;
        $username = $_SESSION['username'];
        parent::connect();
        parent::query("UPDATE users SET roomID='$roomID' WHERE username='$username'");
    }
    
    public static function isRoomAdmin($roomID)
    {
        $userID = $_SESSION['userID'];
        // echo 'UserID: ' . $userID;
        // echo '</br>roomID: ' . $roomID;
        parent::connect();
        $result = parent::query("SELECT * FROM chatrooms WHERE id='$roomID'");
        $row = mysql_fetch_assoc($result);
        $roomAdmin = $row['roomCreatorID'];
        // echo '</br>Room Admin: ' . $roomAdmin;
        if ($userID == $roomAdmin) {
            return true;
        }
    }
}
?>
