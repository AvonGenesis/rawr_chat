<?php
require_once 'php/db/chatrooms.class.php';
session_start();
if (isset($_SESSION['username'])) {
    $message = $_POST['text'];
    Chatrooms::postUserMessage($message);
}
?>
