<?php
require_once 'php/classes/db.class.php';
class Chatlog extends DB
{
    public static function displayChat()
    {
        @session_start();
        parent::connect();
        $roomID = $_SESSION['sessroomID'];
        $result = parent::query("SELECT * FROM chatlog WHERE roomID='$roomID' ORDER BY id DESC LIMIT 10");
        while ($row = $result->fetch_assoc()) {
            if ($row["nickname"] == "SYSTEM") {
                echo '<dl>';
                echo '<dt></dt>';
                echo '<dd id="system">-- ' . htmlspecialchars($row["text"], ENT_QUOTES) . ' -- </dd>';
                echo '</dl>';
            } else {
                echo '<dl>';
                ?>
                <dt><img src="images/avatar.png" style="background-color:<?php echo '#' . $row["color"]; ?>"> <?php echo $row["nickname"] . '</img></dt>';?>
                <dd style="background-color:<?php echo '#' . $row["color"]; ?>; background-image:url('/images/background.png');"> <?php echo htmlspecialchars($row["text"], ENT_QUOTES) . '</dd>';
                echo '</dl>';
            }
        }
        /**
         * TODO: Would like to only use 1 query in this function
         * Reason for this is displaying duplicate chat when entering
         */
        $lastID = parent::query("SELECT * FROM chatlog WHERE roomID='$roomID' ORDER BY id DESC LIMIT 1");
        $lastRow = $lastID->fetch_assoc();
        $_SESSION['sesschatID'] = $lastRow["id"];
    }
    
    public static function displayNewMessage()
    {
        @session_start();
        parent::connect();
        $roomID = $_SESSION['sessroomID'];
        $result = parent::query("SELECT * FROM chatlog WHERE roomID='$roomID' ORDER BY id DESC");
        $row = $result->fetch_assoc();
        if ($_SESSION['sesschatID']!= $row['id']) {
            $_SESSION['sesschatID'] = $row['id'];
            if ($row["nickname"] == "SYSTEM") {
                //echo '<dl><embed src="sound/durarara_chat.mp3" hidden=true autostart=true loop=false>';
                echo '<dl>';
                echo '<dt></dt>';
                echo '<dd id="system">-- ' . htmlspecialchars($row["text"], ENT_QUOTES) . ' -- </dd>';
                echo '</dl>';
            } else {
                echo '<dl>';?>
                <!--
                if ($row['nickname'] != $_SESSION['sessnickname']) {
                   echo '<embed src="sound/durarara_chat.mp3" hidden=true autostart=true loop=false>';
                }?>
                //-->
                <dt><img src="images/avatar.png" style="background-color:<?php echo '#' . $row["color"]; ?>"> <?php echo $row["nickname"] . '</img></dt>';?>
                <dd style="background-color:<?php echo '#' . $row["color"]; ?>; background-image:url('/images/background.png');"> <?php echo htmlspecialchars($row["text"], ENT_QUOTES) . '</dd>';
                echo '</dl>';
            }
        }
    }
}
?>
