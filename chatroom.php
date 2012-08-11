<?php
require_once ('header.html');
require_once ('php/db/users.class.php');
require_once ('php/db/chatrooms.class.php');
if (isset($_POST['roomname'])) {
    $roomName = mysql_real_escape_string($_POST['roomname']);
    $roomID = Chatrooms::createChatroom($roomName);
}
@session_start();
if (isset($_POST['roomID']))
{
    $roomID = $_POST['roomID'];
}
Users::setRoomID($roomID);
if (isset($_POST['delete'])) {
    Chatrooms::deleteChatroom();
}
Users::isRoomAdmin($roomID);
?>
<div id="chatroom-input">
    <?php 
    if (Chatrooms::stillExist()){
        //TODO: change input for text to a textarea
    echo '<form name="message" action="">
            <input name="msg" type="text" id="msg" size="63" /> </br>
            <input name="sendmsg" type="submit"  id="sendmsg" value="POST!" />
        </form>';      
    }
    ?>
</div>
<div id="chatlog">
    <?php
    $username = $_SESSION['username'];
    $text = $username . ' has entered the chatroom.';
    Chatrooms::postMessage($text, $roomID);
    include 'chat_container_first.php';
    ?>
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript" src="js/loadChatlog.js"></script>
<script type="text/javascript">
// jQuery Document
$(document).ready(function(){
    $("#msg").focus();
    //If user submits the form
    $("#sendmsg").click(function(){	
            var clientmsg = $("#msg").val();
            $.post("post.php", {text: clientmsg});				
            $("#msg").attr("value", "");
            $("#msg").focus();
            return false;
    });

    // Reload page on set timer
    setInterval(loadLog, 1000);

    window.onbeforeunload = confirmExit;
    function confirmExit()
    {
      return "Are you sure you want to leave the chatroom?";
      window.location = 'lobby.php?lobby=true';
    }
});
</script>

<?php
require_once ('footer.html');
?>
