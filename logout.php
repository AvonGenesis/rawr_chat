<?php
if (session_start() == true) {
    include_once 'php/classes/users.class.php';
    $username = $_SESSION['sessusername'];
    $roomID = (int)$_SESSION['sessroomID'];
    $text = $username . ' has left the chatroom.';
    Users::logout($username, $roomID, $text);
    session_destroy();
    header('Location: index.php?logout=successful');    
}
?>
