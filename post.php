<?php
require_once 'php/classes/chatrooms.class.php';
session_start();
if (isset($_SESSION['sessusername'])) {
    $message = $_POST['text'];
    Chatrooms::postUserMessage($message);
}
?>
