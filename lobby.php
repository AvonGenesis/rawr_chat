<?php
require_once('php/db/users.class.php');
require_once('php/db/chatrooms.class.php');
@session_start();
if (isset($_SESSION['userID'])) {
    $roomID   = $_SESSION['roomID'];
    $username = $_SESSION['username'];
    Chatrooms::postMessage($username . ' has left the chatroom.', $roomID);
    $_SESSION['chatID'] = NULL;
    Users::setRoomID(NULL);
}

require_once('header.html');
?>
<div class="container hero-unit" style="padding:20px;">
    <?php
require_once 'php/db/chatrooms.class.php';
Chatrooms::getChatroomList();
?>
</div>
<!-- Refresh Lobby Doesn't Work Anymore
<script type="text/javascript">
    $(document).ready(function(){
        //TODO: Don't forget to uncomment for lobby updates
        setInterval(loadLobby, 1000);
    });
</script>
-->

<?php
require_once('footer.html');
?>
