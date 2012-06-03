<script type="text/javascript">
function redirect(){
    window.location = "lobby.php?roomClosed=true"
}
</script>
<?php
require_once 'PHP/DB/chatlog.class.php';
require_once 'PHP/DB/chatrooms.class.php';
if (Chatrooms::stillExist()){
    Chatlog::displayChat();
}
else {
    echo "<script>redirect();</script>";
}
?>
