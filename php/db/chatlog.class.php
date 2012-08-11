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
            if ($row["username"] == "SYSTEM") {
                echo '<dl>';
                echo '<dt></dt>';
                echo '<dd id="system">-- ' . $row["text"] . ' -- </dd>';
                echo '</dl>';
            } else {
                echo '<dl>';
                ?>
                <dt><img src="images/<?php echo $row["picture"];?>.png"> <?php echo $row["username"] . '</img></dt>';?>
                <dd style="background-image:url('/images/<?php echo $row["picture"];?>b.png');"> <?php echo $row["text"] . '</dd>';
                echo '</dl>';
            }
        }
        //TODO: Would like to only use 1 query in this function
        //Reason for this is displaying duplicate chat when entering
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
            if ($row["username"] == "SYSTEM") {
                echo '<dl>';
                echo '<dt></dt>';
                echo '<dd id="system">-- ' . $row["text"] . ' -- </dd>';
                echo '</dl>';
            } else {
                echo '<dl>';?>
                <dt><img src="images/<?php echo $row["picture"];?>.png"> <?php echo $row["username"] . '</img></dt>';?>
                <dd style="background-image:url('/images/<?php echo $row["picture"];?>b.png');"> <?php echo $row["text"] . '</dd>';
                echo '</dl>';
            }
        }
    }
}
?>
