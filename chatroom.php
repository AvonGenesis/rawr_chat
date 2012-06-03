<?php
require_once 'PHP/DB/users.class.php';
require_once 'PHP/DB/chatrooms.class.php';
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
    </head>
    <body>
        <div id="wrapper">	
            <a href="logout.php">Logout</a></br>
            <a id ="lobby" href="#">Lobby</a></br>
            <?php
            Users::isRoomAdmin();
            ?>
            <div id="chatbox">
                <?php
                include 'chat_container.php';
                ?>
            </div>
            <?php 
            if (Chatrooms::stillExist()){
            echo '<form name="message" action="">
                    <input name="msg" type="text" id="msg" size="63" />
                    <input name="sendmsg" type="submit"  id="sendmsg" value="Send" />
            </form>';      
            }
            ?>
        </div>

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
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

            //Load the file containing the chat log
            function loadLog(){		
                    var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
                    $.ajax({
                            url: "chat_container.php",
                            cache: false,
                            success: function(html){		
                                    $("#chatbox").html(html); //Insert chat log into the #chatbox div				
                                    var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
                                    if(newscrollHeight > oldscrollHeight){
                                            $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                                    }				
                            }
                    });
            }
            var refreshChatlog = setInterval(loadLog, 1000);	//Reload file every 2.5 seconds

            //If user wants to end session
            $("#lobby").click(function(){
                    var exit = confirm("Are you sure you want leave the chatroom?");
                    if(exit==true){window.location = 'lobby.php?lobby=true';}		
            });
        });
        </script>
    </body>
</html>
