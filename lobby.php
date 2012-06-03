<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Lobby</title>
        <link rel="stylesheet" type="text/css" href="CSS/base.css"/>
        <link rel="stylesheet" type="text/css" href="CSS/lobby.css"/>
    </head>
    <body>
        <?php
        require_once 'PHP/DB/users.class.php';
        session_start();
        if(isset($_GET['lobby'])){
            Users::setRoomID(null);
        }
        if(isset($_GET['roomClosed']) && $_GET['roomClosed']){
            echo 'The room has closed.';
        }
        echo '<a href="logout.php">Logout</a></br>';
        echo '<a href="create.php">Create Room</a></br></br>';
        ?>
        <div id="lobbyList"><?php include 'lobby_list.php' ?></div>
        
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
        <script type="text/javascript" src="JS/loadLobby.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                //TODO: Don't forget to uncomment for lobby updates
                //setInterval(loadLobby, 1000);
            });
        </script>
    </body>
</html>
