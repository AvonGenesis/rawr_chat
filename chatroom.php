<?php
require_once 'php/classes/users.class.php';
require_once 'php/classes/chatrooms.class.php';
if (isset($_POST['roomname'])) {
    $roomName = $_POST['roomname'];
    $roomID = Chatrooms::createChatroom($roomName);
}
if (isset($_POST['roomID'])) {
    $roomID = $_POST['roomID'];
}
Users::setRoomID($roomID);
if (isset($_POST['delete'])) {
    Chatrooms::deleteChatroom();
}
require_once 'header.php';
?>
<link rel="stylesheet" href="css/chatroom.css">
<div class="container-fluid" style="background-color:#ffffff; margin-top: -20px;">
    <div class="row-fluid">
        <div class="span12">
            <div class="row-fluid">
                <div class="span3"></div>
                <?php
                if (Chatrooms::stillExist()) {
                    //TODO: change input for text to a textarea
                    echo '<form class="span6" name="message" action="">
                        <input name="msg" type="text" id="msg" style="width:100%; margin-top:15px;"/></br>
                        <input name="sendmsg" type="submit" id="sendmsg" value="POST!"/>
                    </form>';
                }
                ?>
                <div class="span3"></div>

            </div>
        </div>
    </div>
</div>
<div class="container" id="chatlog">
    <?php
    $nickname = $_SESSION['sessnickname'];
    $text = $nickname . ' has entered the chatroom.';
    Chatrooms::postMessage($text, $roomID);
    require_once 'chat_container_first.php';
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
require_once 'footer.php';
?>
