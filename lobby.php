<?php
require_once ('header.html');
require_once ('php/db/users.class.php');
require_once ('php/db/chatrooms.class.php');

if (isset($_SESSION['userID']))
{
    $roomID = $_SESSION['roomID'];
    $username = $_SESSION['username'];
}

if (isset($_GET['lobby'])) {
    Chatrooms::postMessage($username . ' has left the chatroom.', $roomID);
    $_SESSION['chatID'] = null;
    Users::setRoomID(null);
}
?>
<div class="container">
    <?php
    require_once 'php/db/chatrooms.class.php';
    Chatrooms::getChatroomList();
    ?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        //TODO: Don't forget to uncomment for lobby updates
        setInterval(loadLobby, 1000);
    });
</script>

<?php
require_once ('footer.html');
?>
