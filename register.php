<?php

require_once 'php/classes/users.class.php';

if (isset($_POST['username'])) {
    if (strlen($_POST['username']) < 4) {
        echo '<div class="container alert alert-error fade in">
            <button class="close" data-dismiss="alert">×</button>
            Username must be at least 4 characters long!
            </div>';
        include_once 'header.html';
        include_once 'register_form.php';
        include_once 'footer.html';
        die();
    }
    
    if (strlen($_POST['nickname']) < 1) {
        echo '<div class="container alert alert-error fade in">
            <button class="close" data-dismiss="alert">×</button>
            Please enter a nickname!
            </div>';
        include_once 'header.html';
        include_once 'register_form.php';
        include_once 'footer.html';
        die();
    }
    
    if (strlen($_POST['color']) < 6) {
        echo '<div class="container alert alert-error fade in">
            <button class="close" data-dismiss="alert">×</button>
            Please choose a color!
            </div>';
        include_once 'header.html';
        include_once 'register_form.php';
        include_once 'footer.html';
        die();
    }
    
    if (!isset($_POST['password1']) || strlen($_POST['password1']) < 6) {
        echo '<div class="container alert alert-error fade in">
            <button class="close" data-dismiss="alert">×</button>
            Password must be at least 4 characters long!
            </div>';
        include_once 'header.html';
        include_once 'register_form.php';
        include_once 'footer.html';
        die();
    }
    
    if (!isset($_POST['password2']) || strlen($_POST['password2']) < 6) {
        echo '<div class="container alert alert-error fade in">
            <button class="close" data-dismiss="alert">×</button>
            Password must be at least 4 characters long!
            </div>';
        include_once 'header.html';
        include_once 'register_form.php';
        include_once 'footer.html';
        die();
    }
    
    if ($_POST['password1'] != $_POST['password2']) {
        echo '<div class="container alert alert-error fade in">
            <button class="close" data-dismiss="alert">×</button>
            Passwords do not match!
            </div>';
        include_once 'header.html';
        include_once 'register_form.php';
        include_once 'footer.html';
        die();
    }
    
    $username  = $_POST['username'];
    $nickname  = $_POST['nickname'];
    $password1 = crypt($_POST['password1']);
    $color     = str_replace("#", "", $_POST['color']);

    $result = Users::register($username, $nickname, $password1, $color);
    
    if ($result) {
        header('Location: index.php?register=success');
    } else if (mysql_errno() == 1062) {
        echo '<div class="container alert alert-error fade in">
            <button class="close" data-dismiss="alert">×</button>
            Username is already in use!
            </div>';
        include_once 'header.html';
        include_once 'register_form.php';
        include_once 'footer.html';
        die();
    }
}
require_once 'header.php';
require_once 'register_form.php';
?>
