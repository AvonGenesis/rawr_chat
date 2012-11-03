<?php
require_once 'php/db/db.class.php';
class Chatlog extends DB
{
    public static function displayChat()
    {
        @session_start();
        parent::connect();
        $roomID = $_SESSION['roomID'];
        $result = parent::query("SELECT * FROM chatlog WHERE roomID='$roomID' ORDER BY id DESC LIMIT 10");
        while ($row = mysql_fetch_assoc($result)) {
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
        $lastRow = mysql_fetch_assoc($lastID);
        $_SESSION['chatID'] = $lastRow["id"];
    }
    
    public static function displayNewMessage()
    {
        @session_start();
        parent::connect();
        $roomID = $_SESSION['roomID'];
        $result = parent::query("SELECT * FROM chatlog WHERE roomID='$roomID' ORDER BY id DESC");
        $row = mysql_fetch_assoc($result);
        if ($_SESSION['chatID']!= $row['id']) {
            $_SESSION['chatID'] = $row['id'];
            if ($row["nickname"] == "SYSTEM") {
                //echo '<dl><embed src="sound/durarara_chat.mp3" hidden=true autostart=true loop=false>';
                echo '<dl>';
                echo '<dt></dt>';
                echo '<dd id="system">-- ' . htmlspecialchars($row["text"], ENT_QUOTES) . ' -- </dd>';
                echo '</dl>';
            } else {
                echo '<dl>';?>
                <!--
                if ($row['nickname'] != $_SESSION['nickname']) {
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
