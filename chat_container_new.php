<script type="text/javascript">
function redirect(){
    window.location = "lobby.php"
}
</script>
<?php
require_once 'php/classes/chatlog.class.php';
require_once 'php/classes/chatrooms.class.php';
if (Chatrooms::stillExist()) {
    Chatlog::displayNewMessage();
} else {
    echo "<script>redirect();</script>";
}
?>
