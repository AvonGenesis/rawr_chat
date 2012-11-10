<?php
require_once 'php/classes/db.class.php';
class Users extends DB
{
    public static function login($username, $password)
    {
        parent::connect();
        $result = parent::query("SELECT * FROM users WHERE username='$username'");
        
        if ($result->num_rows < 1) {
            return false;
        } else {
            $row = $result->fetch_assoc();
            if (crypt($password, $row['password']) == $row['password'])
            {
                return true;
            }
            else {
                return false;
            }
        }
    }
    
    public static function setSession($username)
    {
        parent::connect();
        $result = parent::query("SELECT * FROM users WHERE username='$username'");
        $row = $result->fetch_assoc();
        $_SESSION['sessuserID']   = $row['id'];
        $_SESSION['sessusername'] = $username;
        $_SESSION['sessnickname'] = $row['nickname'];
        $_SESSION['sessroomID']   = null;
        $_SESSION['sesschatID']   = null;
        $_SESSION['sesscolor']    = $row['color'];
        parent::query("UPDATE users SET lastLogin=NOW() WHERE username='$username'");
    }
    
    public static function logout($username, $roomID, $text)
    {
        parent::connect();
        parent::query("UPDATE users SET roomID=null WHERE username='$username'");
        if (!is_null($roomID)) {
            parent::query("INSERT INTO chatlog (nickname, roomID, text) VALUES ('SYSTEM', '$roomID' , '$text')");
        }
    }
    
    public static function register($username, $nickname, $password, $color)
    {
        parent::connect();
        return parent::query("INSERT INTO users (username,nickname,password,color) VALUES ('$username', '$nickname', '$password', '$color')");        
    }
    
    public static function changePassword($username, $currentPassword, $newPassword1, $newPassword2)
    {
        $incorrectPassword = '<div class="container alert alert-error fade in">
            <button class="close" data-dismiss="alert">&times;</button>
            The password you entered is incorrect!
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
        
        parent::connect();
        $result = parent::query("SELECT * FROM users WHERE username='$username'");
        $row = $result->fetch_assoc();
        
        if (crypt($currentPassword, $row['password']) != $row['password']) {
            return $incorrectPassword;
        }
        
        $newPassword1 = crypt($newPassword1, $row['password']);
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
        $reservedName = '<div class="container alert alert-error fade in">
            <button class="close" data-dismiss="alert">&times;</button>
            This is a reserved nickname! Pick a different one.
            </div>';
        $nickname = str_replace(' ','',$nickname);
        $myFile = "restricted_names.txt";
        $fh = fopen($myFile, 'r');
        $match = FALSE;
        while(!feof($fh)) {
            $theData = fgets($fh);
            $compare = strcasecmp(trim((string)$theData), trim((string)$nickname));
            if ($compare == 0) {
                $match = TRUE;
                break;
            }
        }
        if ($match) {
            return $reservedName;
        }
        else {
            parent::connect();
            $result = parent::query("UPDATE users set nickname='$nickname' WHERE username='$username'");

            if ($result) {
                $_SESSION['sessnickname'] = $nickname;
                return $successful;
            }
        }
    }
    
    public static function changeColor($username, $color)
    {
        $successful = '<div class="container alert alert-success fade in">
            <button class="close" data-dismiss="alert">&times;</button>
            Color changed successfully.
            </div>';
        $color = str_replace("#", "", $color);
        parent::connect();
        $result = parent::query("UPDATE users set color='$color' WHERE username='$username'");
        if ($result) {
            $_SESSION['sesscolor'] = $color;
            return $successful;
        }
    }
    
    public static function getUserID($username)
    {
        parent::connect();
        $result = parent::query("SELECT * FROM users WHERE username='$username'");
        $row = $result->fetch_assoc();
        return $row['id'];
    }
    
    public static function getUserColor($username)
    {
        parent::connect();
        $result = parent::query("SELECT * FROM users WHERE username='$username'");
        $row = $result->fetch_assoc();
        return $row['color'];
    }
    public static function setRoomID($roomID)
    {
        @session_start();
        $_SESSION['sessroomID'] = $roomID;
        $username = $_SESSION['sessusername'];
        parent::connect();
        parent::query("UPDATE users SET roomID='$roomID' WHERE username='$username'");
    }
    
    public static function isRoomAdmin($roomID)
    {
        $userID = $_SESSION['sessuserID'];
        // echo 'UserID: ' . $userID;
        // echo '</br>roomID: ' . $roomID;
        parent::connect();
        $result = parent::query("SELECT * FROM chatrooms WHERE id='$roomID'");
        $row = $result->fetch_assoc();
        $roomAdmin = $row['roomCreatorID'];
        // echo '</br>Room Admin: ' . $roomAdmin;
        if ($userID == $roomAdmin) {
            return true;
        }
    }
}
?>
