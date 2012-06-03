<?php 
    require_once 'PHP/DB/users.class.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Web Chat</title>
        <link rel="stylesheet" type="text/css" href="CSS/base.css"/>
    </head>
    <body>
        <?php
        session_start();
        if (isset($_REQUEST['username']) && isset($_REQUEST['password'])){
            $username = $_REQUEST['username'];
            $password = md5($_REQUEST['password']);
            $login = Users::login($username, $password);           
            if(!$login) {
                echo 'The username and password you entered do not match!';
            }
            else{
                $_SESSION['userID'] = Users::getUserID($username);
                $_SESSION['username'] = $username;
                $_SESSION['roomID'] = NULL;
                header( 'Location: lobby.php' );
            }            
        }
        if(!isset($_SESSION['username'])) {
            include 'login_form.php';
        } else {
            echo '</br><a href="logout.php">logout</a>';
            header( 'Location: lobby.php' );
        }
        ?>
    </body>
</html>
