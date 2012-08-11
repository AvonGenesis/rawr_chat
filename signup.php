<?php
require_once ('header.html');
require_once ('php/db/users.class.php');

if (isset($_POST['username'])) {
    if(strlen($_POST['username']) < 1 ) {
        require_once ('register_form.php');
        require_once ('footer.html');
        die();
    }
    
    if(!isset($_POST['password1']) || strlen($_POST['password1']) < 4  ) {
        require_once ('register_form.php');
        require_once ('footer.html');
        die();
    }

    if(!isset($_POST['password2']) || strlen($_POST['password2']) < 4  ) {
        require_once ('register_form.php');
        require_once ('footer.html');
        die();
    }

    $username = $_POST['username'];
    $password1 = md5( $_POST['password1'] );
    $password2 = md5( $_POST['password2'] );
    $picture = $_POST['avatar'];

    if($password1 != $password2) {
        require_once ('register_form.php');
        require_once ('footer.html');
        die();
    }

    $result = Users::register($username, $password1, $picture);

    if ($result) {
        header( 'Location: index.php' );
    } else if (mysql_errno() == 1062) {
        require_once ('register_form.php');
        require_once ('footer.html');
        die();
    }
}

require_once ('register_form.php');
require_once ('footer.html');
?>
