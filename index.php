<?php 
require_once ('header.html');
require_once ('php/db/users.class.php');

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
        $_SESSION['chatID'] = NULL;
        header('Location: lobby.php');
    }            
}
?>
<div class="container">
    <h1>MAIN PAGE</h1>
</div>


<?php
require_once 'footer.html';
?>
