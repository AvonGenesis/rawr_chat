<?php
require_once 'php/db/users.class.php';
require_once 'php/db/chatrooms.class.php';
session_start();
$roomID = $_POST['roomID'];
Users::setRoomID($roomID);
if (isset($_POST['delete'])) {
    Chatrooms::deleteChatroom();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Chatroom</title>
        <link rel="stylesheet" type="text/css" href="css/chatroom.css"/>
    </head>
    <body>
        <div id="top-menu">
            <div id="navbar">
                <div id="navigation">
                    <a id="logout" href="logout.php">Logout</a> | 
                    <a id="lobby" href="#">Lobby</a></br>
                </div>
                <?php
                Users::isRoomAdmin();
                ?>
            </div>
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

            // If user wants to end session
            $("#lobby").click(function(){
                    var exit = confirm("Are you sure you want leave the chatroom?");
                    if(exit==true){window.location = 'lobby.php?lobby=true';}		
            });
        });
        </script>
    </body>
</html>
