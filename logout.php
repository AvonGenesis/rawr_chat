<?php
if (session_start() == true) {
    include_once 'php/db/users.class.php';
    $username = $_SESSION['username'];
    $roomID = (int)$_SESSION['roomID'];
    $text = $username . ' has left the chatroom.';
    Users::logout($username, $roomID, $text);
    session_destroy();
    header('Location: index.php?logout=successful');    
}
?>
