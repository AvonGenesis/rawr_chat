<?php 
@session_start(); 
$roomID = $_SESSION['roomID']; 
?>
<form action="chatroom.php" method="post">
    <input type="hidden" name="roomID" value="<?php echo $roomID; ?>"/>
    <input type="checkbox" name="delete" value="Delete chatroom"  />
    <input id="submit" type="submit" value="Delete chatroom" />
</form>
