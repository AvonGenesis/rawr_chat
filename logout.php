<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Logout</title>
        <script type="text/javascript">
        function delayer(){
            window.location = "index.php?logout=successful"
        }
        </script>
    </head>
    <body onLoad="setTimeout('delayer()', 0)">
        <?php
        if (session_start() == true) {
            include_once 'php/db/users.class.php';
            $username = $_SESSION['username'];
            $roomID = (int)$_SESSION['roomID'];
            $text = $username . ' has left the chatroom.';
            Users::logout($username, $roomID, $text);
            session_destroy();       
        }
        ?>
    </body>
</html>
