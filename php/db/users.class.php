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
            return true;
        }
    }
    
    public static function setSession($username)
    {
        parent::connect();
        $result = parent::query("SELECT * FROM users WHERE username='$username'");
        $row = mysql_fetch_assoc($result);
        $_SESSION['userID']   = $row['id'];
        $_SESSION['username'] = $username;
        $_SESSION['nickname'] = $row['nickname'];
        $_SESSION['roomID']   = NULL;
        $_SESSION['chatID']   = NULL;
        $_SESSION['color']    = $row['color'];
        $_SESSION['picture']  = $row['picture'];
    }
    
    public static function logout($username, $roomID, $text)
    {
        parent::connect();
        parent::query("UPDATE users SET roomID=null WHERE username='$username'");
        if (!is_null($roomID)) {
            mysql_query("INSERT INTO chatlog (username, roomID, text) VALUES ('SYSTEM', '$roomID' , '$text')");
        }
    }
    
    public static function register($username, $nickname, $password, $picture, $color)
    {
        parent::connect();
        return parent::query("INSERT INTO users (username,nickname,password,picture,color) VALUES ('$username', '$nickname', '$password', '$picture', '$color')");        
    }
    
    public static function changePassword($username, $currentPassword, $newPassword1, $newPassword2)
    {
        $incorrectPassword = '<div class="container alert alert-error fade in">
            <button class="close" data-dismiss="alert">&times;</button>
            That password you entered is incorrect!
            </div>';
        
        $minLength = '<div class="container alert alert-error fade in">
            <button class="close" data-dismiss="alert">&times;</button>
            Password must be 6 characters long!
            </div>';
        
        $passwordDoNotMatch = '<div class="container alert alert-error fade in">
            <button class="close" data-dismiss="alert">&times;</button>
            Passwords do not match!
            </div>';
        
        $successful = '<div class="container alert alert-success fade in">
            <button class="close" data-dismiss="alert">&times;</button>
            Password changed successfully.
            </div>';
        
        if ((strlen($newPassword1) < 6) && (strlen($newPassword2) < 6)) {
            return $minLength;
        }
        
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
    
    public static function changeNickname($username, $nickname)
    {
        $successful = '<div class="container alert alert-success fade in">
            <button class="close" data-dismiss="alert">&times;</button>
            Nickname changed successfully.
            </div>';
        
        parent::connect();
        $result = parent::query("UPDATE users set nickname='$nickname' WHERE username='$username'");
        
        if ($result) {
            $_SESSION['nickname'] = $nickname;
            return $successful;
        }
    }
    
    public static function changeColor($username, $color)
    {
        $successful = '<div class="container alert alert-success fade in">
            <button class="close" data-dismiss="alert">&times;</button>
            Nickname changed successfully.
            </div>';
        $color = str_replace("#", "", $color);
        parent::connect();
        $result = parent::query("UPDATE users set color='$color' WHERE username='$username'");
        if ($result) {
            $_SESSION['color'] = $color;
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
