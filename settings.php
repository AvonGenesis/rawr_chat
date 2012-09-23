<?php
require_once 'header.html';
require_once 'php/db/users.class.php';

if (isset($_SESSION['userID'])) {
    $roomID   = $_SESSION['roomID'];
    $nickname = $_SESSION['nickname'];
    Chatrooms::postMessage($nickname . ' has left the chatroom.', $roomID);
    $_SESSION['chatID'] = null;
    Users::setRoomID(null);
}

if (isset($_POST['password1'])) {
    $username = $_SESSION['username'];
    echo Users::changePassword($username, $_POST['currentPassword'], $_POST['password1'], $_POST['password2']);
}

if (isset($_POST['nickname'])) {
    echo Users::changeNickname($_SESSION['username'], $_POST['nickname']);
}

if (isset($_POST['color'])) {
    echo Users::changeColor($_SESSION['username'], $_POST['color']);
}
?>
<link rel="stylesheet" href="colorpicker/css/colorpicker.css" />
<style type="text/css">
#chatBackground {
    background-image: url('/images/background.png');
    background-size: 1px 40px;
    background-repeat:repeat-x;
    width:80%;
    border-style: solid;
    border-radius: 15px;
    border-width: 5px;
    border-color: #ffffff;
    height: 30px;
    font-size: 20px;
    padding-top: 10px;
    position:relative;
    top: -55px;
    left: 75px;
}
</style>
<div class="container">
    <div class="row">
        <div class="span6">
            <form action="settings.php" method="post" class="well form-horizontal">
                <label><h3><center>Change Password</center></h3></label></br>
                <div class="control-group">
                    <label class="control-label" for="currentPassword">Current Password</label>
                    <div class="controls">
                        <input type="password" class="input-xlarge" id="currentPassword" name="currentPassword">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="password1">New Password</label>
                    <div class="controls">
                        <input type="password" class="input-xlarge" id="password1" name="password1">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="password2">Verify Password</label>
                    <div class="controls">
                        <input type="password" class="input-xlarge" id="password2" name="password2">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="display:block; margin-right:auto; margin-left: auto;">Change Password</button>
            </form>
        </div>
        <div class="span6">
            <form action="settings.php" method="post" class="well form-horizontal">
                <label><h3><center>Change Nickname</center></h3></label>
                <div class="control-group">
                    <label class="control-label" for="nickname">Nickname</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="nickname" name="nickname">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="display:block; margin-right:auto; margin-left: auto;">Change Nickname</button>
            </form>
            <form action="settings.php" method="post" class="well form-horizontal">
                <label><h3><center>Change Color</center></h3></label>
                <div class="control-group">
                    <label class="control-label" for="input01">Color</label>
                    <div class="controls">
                        <input type="text" class="span1" value="<?php echo '#' . $_SESSION['color'];?>" id="colorpicker" name="color" />
                    </div>
                </div>
                <div id="chatExample" style="background-color: #000000; margin-bottom: 10px; padding: 10px; height: 58px;">
                    <div id="chatIcon"><img src="/images/1.png"/></div>
                    <div id="chatBackground" style="background-color: <?php echo '#' . $_SESSION['color'];?>">
                        <div style="color: #ffffff"><center>TEXT GOES HERE</center></div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="display:block; margin-right:auto; margin-left: auto;">Change Color</button>
            </form>
        </div>
    </div>
</div>
<script src="colorpicker/js/bootstrap-colorpicker.js"></script>
<script>
    $(function(){
        var bodyStyle = $('#chatBackground')[0].style;
        $('#colorpicker').colorpicker().on('changeColor', function(ev){
            bodyStyle.backgroundColor = ev.color.toHex();
        });
    });
    
</script>
<?php
require_once 'footer.html';
?>