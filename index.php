<?php 
require_once ('php/db/users.class.php');
require_once ('header.html');
session_start();
// Handle GET requests
if (isset($_GET['createUser'])) {
    echo '<script type="text/javascript">successCreateUser()</script>';
}

// Process user login
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_REQUEST['username'];
    $password = md5($_REQUEST['password']);
    $login = Users::login($username, $password);           
    if(!$login) {
        echo '<script type="text/javascript">errorLogin();</script>';
    } else {
        $_SESSION['userID'] = Users::getUserID($username);
        $_SESSION['username'] = $username;
        $_SESSION['roomID'] = NULL;
        $_SESSION['chatID'] = null;
        header('Location: lobby.php?login=true');
    }            
}

// Show login and register form if no session
if(!isset($_SESSION['username'])) {
    echo "MAIN PAGE HERE";
} else {
    echo '</br><a href="logout.php">logout</a>';
    header( 'Location: lobby.php?login=true' );
}
require_once 'footer.html';
?>
