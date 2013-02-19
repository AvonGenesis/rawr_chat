<?php
@session_start();
require_once 'header.php';
require_once 'php/classes/users.class.php';
require_once 'php/classes/chatrooms.class.php';

if (!isset($_SESSION['sessuserID'])) {
    header('Location: index.php?login=false');
}

if (isset($_SESSION['sessuserID'])) {
    $roomID   = $_SESSION['sessroomID'];
    $nickname = $_SESSION['sessnickname'];
    Chatrooms::postMessage($nickname . ' has left the chatroom.', $roomID);
    $_SESSION['sesschatID'] = null;
    Users::setRoomID(null);
}

if (isset($_POST['password1'])) {
    $username = $_SESSION['sessusername'];
    echo Users::changePassword($username, $_POST['currentPassword'], $_POST['password1'], $_POST['password2']);
}

if (isset($_POST['nickname'])) {
    echo Users::changeNickname($_SESSION['sessusername'], $_POST['nickname']);
}

if (isset($_POST['color'])) {
    echo Users::changeColor($_SESSION['sessusername'], $_POST['color']);
}
?>
<link rel="stylesheet" href="colorpicker/css/colorpicker.css" />
<style type="text/css">
#chatBackground {
    background-image: url('images/background.png');
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
                        <input type="text" class="span1" value="<?php echo '#' . $_SESSION['sesscolor'];?>" id="colorpicker" name="color" />
                    </div>
                </div>
                <div id="chatExample" style="background-color: #000000; margin-bottom: 10px; padding: 10px; height: 58px;">
                    <div id="chatIcon" style="width: 58px; background-color: <?php echo '#' . $_SESSION['sesscolor'];?>"><img src="images/avatar.png"/></div>
                    <div id="chatBackground" style="background-color: <?php echo '#' . $_SESSION['sesscolor'];?>">
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
        var chatStyle = $('#chatBackground')[0].style;
        $('#colorpicker').colorpicker().on('changeColor', function(ev){
            chatStyle.backgroundColor = ev.color.toHex();
        });
        
        var iconStyle = $('#chatIcon')[0].style;
        $('#colorpicker').colorpicker().on('changeColor', function(ev){
            iconStyle.backgroundColor = ev.color.toHex();
        });
    });
    
</script>
<?php
require_once 'footer.php';
?>