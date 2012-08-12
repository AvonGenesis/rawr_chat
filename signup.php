<?php
require_once ('header.html');
require_once ('php/db/users.class.php');

if (isset($_POST['username'])) {
    if(strlen($_POST['username']) < 4 ) {
        echo '<div class="container alert alert-error fade in">
            <button class="close" data-dismiss="alert">×</button>
            Username must be at least 4 characters long!
            </div>';
        require_once ('register_form.php');
        require_once ('footer.html');
        die();
    }
    
    if(!isset($_POST['password1']) || strlen($_POST['password1']) < 4  ) {
        echo '<div class="container alert alert-error fade in">
            <button class="close" data-dismiss="alert">×</button>
            Password must be at least 4 characters long!
            </div>';
        require_once ('register_form.php');
        require_once ('footer.html');
        die();
    }

    if(!isset($_POST['password2']) || strlen($_POST['password2']) < 4  ) {
        echo '<div class="container alert alert-error fade in">
            <button class="close" data-dismiss="alert">×</button>
            Password must be at least 4 characters long!
            </div>';
        require_once ('register_form.php');
        require_once ('footer.html');
        die();
    }

    $username = $_POST['username'];
    $password1 = md5( $_POST['password1'] );
    $password2 = md5( $_POST['password2'] );
    $picture = $_POST['avatar'];

    if($password1 != $password2) {
        echo '<div class="container alert alert-error fade in">
            <button class="close" data-dismiss="alert">×</button>
            Passwords do not match!
            </div>';
        require_once ('register_form.php');
        require_once ('footer.html');
        die();
    }

    $result = Users::register($username, $password1, $picture);

    if ($result) {
        header( 'Location: index.php?register=success' );
    } else if (mysql_errno() == 1062) {
        echo '<div class="container alert alert-error fade in">
            <button class="close" data-dismiss="alert">×</button>
            Username is already in use!
            </div>';
        require_once ('register_form.php');
        require_once ('footer.html');
        die();
    }
}

require_once ('register_form.php');
require_once ('footer.html');
?>
