<script type="text/javascript">
function redirect(){
    window.location = "lobby.php?roomClosed=true"
}
</script>
<?php
require_once 'php/db/chatlog.class.php';
require_once 'php/db/chatrooms.class.php';
if (Chatrooms::stillExist()){
    Chatlog::displayNewMessage();
}
else {
    echo "<script>redirect();</script>";
}
?>
