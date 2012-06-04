<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Create Chatroom</title>
        <link rel="stylesheet" type="text/css" href="css/base.css"/>
        <link rel="stylesheet" type="text/css" href="css/create_chatroom.css"/>

    </head>
    <body>
        <?php
        require_once 'php/db/chatrooms.class.php';
        echo '<a href="lobby.php">Go back to lobby</a></br>';
        if (isset($_POST['roomname'])) {

            $roomName = mysql_real_escape_string($_POST['roomname']);
            Chatrooms::createChatroom($roomName);
        }
        
        else {?>
        <div id="create-chatroom">
            <form action="create.php" method="post">
                <div id="create-room">Create chatroom</div>
                <div id="room-name">Room name:</br>
                    <input type="text" name="roomname" placeholder="Enter chatroom name here"/></br>
                </div>
                <input id ="submit" type="submit" value="Create" />
            </form>
        </div>
        <?php
        }
        ?>
        
        
        

        
    </body>
</html>
