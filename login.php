<?php
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
    require_once 'php/classes/users.class.php';
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $login = Users::login($username, $password);
    if (!$login) {
        echo '<div class="container alert alert-error fade in">
            <button class="close" data-dismiss="alert">&times;</button>
            Invalid username or password!
            </div>';
    } else {
        Users::setSession($username);
        header('Location: index.php');
    }
}
require_once 'header.php';
?>
<div class="container-fluid">
    <form class="form-horizontal" action="login.php" method="post">
        <fieldset>
            <div id="legend" class="">
                <legend class="">Login</legend>
            </div>
            <div class="control-group">

                <!-- Text input-->
                <label class="control-label" for="input01">Username</label>
                <div class="controls">
                    <input type="text" placeholder="Username" class="input-xlarge" name="username">
                    <p class="help-block"></p>
                </div>
            </div>

            <div class="control-group">

                <!-- Text input-->
                <label class="control-label" for="input01">Password</label>
                <div class="controls">
                    <input type="password" placeholder="Password" class="input-xlarge" name="password">
                    <p class="help-block"></p>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label"></label>

                <!-- Button -->
                <div class="controls">
                    <button class="btn btn-primary">Login</button>
                </div>
            </div>

        </fieldset>
    </form>
</div>
</body>
</html>
