<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Lobby</title>
        <link rel="stylesheet" type="text/css" href="css/base.css"/>
        <link rel="stylesheet" type="text/css" href="css/lobby.css"/>
        <link rel="stylesheet" type="text/css" href="css/jquery.noty.css"/>
        <link rel="stylesheet" type="text/css" href="css/noty_theme_default.css"/>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>  
        <script type="text/javascript" src="js/loadLobby.js"></script>
        <script type="text/javascript" src="js/jquery.noty.js"></script>
        <script type="text/javascript" src="js/notyContainer.js"></script>
    </head>

    <body>
        <div id="navbar">
            <a id="logout" href="logout.php">Logout</a> | 
            <a id="create" href="create.php">Create Room</a>
        </div>
        <?php
        require_once 'php/db/users.class.php';
        require_once 'php/db/chatrooms.class.php';
        session_start();            
        $roomID = $_SESSION['roomID'];
        $username = $_SESSION['username'];
        if (isset($_GET['lobby'])) {
            Chatrooms::postMessage($username . ' has left the chatroom.', $roomID);
            $_SESSION['chatID'] = null;
            Users::setRoomID(null);
        }
        if (isset($_GET['login'])) {
            echo '<script type="text/javascript">successLogin()</script>';
        }
        if (isset($_GET['roomClosed'])) {
            echo '<script type="text/javascript">infoRoomClose()</script>';
        }
        if (isset($_GET['createRoom'])) {
            echo '<script type="text/javascript">successCreateRoom()</script>';
        }
        ?>
        <div id="lobbyList"><?php include 'lobby_list.php' ?></div>
        <script type="text/javascript">
            $(document).ready(function(){
                //TODO: Don't forget to uncomment for lobby updates
                setInterval(loadLobby, 1000);
            });
        </script>
    </body>
</html>
