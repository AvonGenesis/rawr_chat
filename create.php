<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once 'PHP/DB/chatrooms.class.php';
        echo '<a href="lobby.php">Go back to lobby</a></br>';
        if (isset($_POST['roomname'])) {

            $roomName = mysql_real_escape_string($_POST['roomname']);
            Chatrooms::createChatroom($roomName);
        }
        
        else {?>
        <form action="create.php" method="post">
            Room name:
            <input type="text" name="roomname" />
            <input type="submit" value="Create" />
        </form>
        
        <?php
        }
        ?>
        
        
        

        
    </body>
</html>
