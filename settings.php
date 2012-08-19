<?php
require_once ('header.html');
require_once ('php/db/users.class.php');

if (isset($_POST['password1'])) {
    $username = $_SESSION['username'];
    echo Users::changePassword($username, $_POST['currentPassword'], $_POST['password1'], $_POST['password2']);
}

if (isset($_POST['nickname'])) {
    echo Users::changeNickname($_SESSION['username'], $_POST['nickname']);
}
?>

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
            
        </div>
    </div>
</div>

<?php
require_once ('footer.html');
?>