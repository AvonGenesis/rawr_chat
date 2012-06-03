<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Logout</title>
        <script type="text/javascript">
        function delayer(){
            window.location = "index.php"
        }
        </script>
    </head>
    <body onLoad="setTimeout('delayer()', 5000)">
    <?php
        if( session_start() == true ) {
            
            require_once 'PHP/DB/users.class.php';
            $username = $_SESSION['username'];
            $roomID = (int)$_SESSION['roomID'];
            $text = $username . ' has left the chatroom.';
            Users::logout($username, $roomID, $text);
            session_destroy();       
        }    
        echo 'You have successfully logged out!';
        echo '</br>You will be redirected to the homepage in 5 seconds.';
        echo '</br><a href="index.php">Click here if you do not wish to wait</a>';
    ?>
    </body>
</html>
