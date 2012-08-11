<?php
require_once ('header.html');
require_once ('php/db/users.class.php');

if (isset($_POST['username'])) {
    if(strlen($_POST['username']) < 1 ) {
        require_once ('register_form.php');
        die();
    }

    if(!isset($_POST['password1']) || strlen($_POST['password1']) < 4  ) {
        die();
    }

    if(!isset($_POST['password2']) || strlen($_POST['password2']) < 4  ) {
        die();
    }

    $username = $_POST['username'];
    $password1 = md5( $_POST['password1'] );
    $password2 = md5( $_POST['password2'] );
    $picture = $_POST['avatar'];

    if($password1 != $password2) {
        die();
    }

    $result = Users::register($username, $password1, $picture);

    if ($result) {
        header( 'Location: index.php?createUser=true' );
    } else if (mysql_errno() == 1062) {
        include 'login_form.php';
        include 'register_form.php';
        echo '<script type="text/javascript">errorUserAlreadyExist();</script>';
        die();
    }
}
require_once ('register_form.php');
require_once ('footer.html');
?>
