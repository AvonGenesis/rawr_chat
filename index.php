<?php 
require_once ('php/db/users.class.php');
require_once ('php/db/chatrooms.class.php');
@session_start();
if (isset($_SESSION['userID'])) {    
    $roomID = $_SESSION['roomID'];
    $username = $_SESSION['username'];
    Chatrooms::postMessage($username . ' has left the chatroom.', $roomID);
    $_SESSION['chatID'] = NULL;
    Users::setRoomID(NULL);
}

require_once ('header.html');

// Process user login
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_REQUEST['username'];
    $password = md5($_REQUEST['password']);
    $login = Users::login($username, $password);           
    if(!$login) {
        echo '<div class="container alert alert-error fade in">
            <button class="close" data-dismiss="alert">×</button>
            Invalid username or password!
            </div>';
    } else {
        $_SESSION['userID'] = Users::getUserID($username);
        $_SESSION['username'] = $username;
        $_SESSION['roomID'] = NULL;
        $_SESSION['chatID'] = NULL;
        header('Location: lobby.php');
    }            
}

if (isset($_GET['register'])) {
    echo '<div class="container alert alert-success fade in">
    <button class="close" data-dismiss="alert">×</button>
    Congratulations! You may now sign in.
    </div>';
}

if (isset($_GET['logout'])) {
    echo '<div class="container alert alert-success fade in">
    <button class="close" data-dismiss="alert">×</button>
    You have successfully signed out.
    </div>';
}
?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span2"></div>
        <div class="span8">
            <h1>Welcome!</h1>
            <p>Tagline</p>
        </div>
        <div class="span2"></div>
    </div>
</div>
<?php
require_once 'footer.html';
?>
