<?php
require_once 'php/classes/users.class.php';
require_once 'php/classes/chatrooms.class.php';
@session_start();
if (!isset($_SESSION['userID'])) {
    header('Location: index.php?login=false');
}
if (isset($_SESSION['userID'])) {
    $roomID = $_SESSION['roomID'];
    $nickname = $_SESSION['nickname'];
    Chatrooms::postMessage($nickname . ' has left the chatroom.', $roomID);
    $_SESSION['chatID'] = null;
    Users::setRoomID(null);
}

require_once 'header.php';
?>
<div class="well well-small container-fluid">
    <?php
    require_once 'php/classes/chatrooms.class.php';
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
require_once 'footer.php';
?>
