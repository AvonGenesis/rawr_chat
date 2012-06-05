<?php 
    require_once 'php/db/users.class.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Web Chat</title>
        <link rel="stylesheet" type="text/css" href="css/base.css"/>      
        <link rel="stylesheet" type="text/css" href="css/jquery.noty.css"/>
        <link rel="stylesheet" type="text/css" href="css/noty_theme_default.css"/>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>        
        <script type="text/javascript" src="js/jquery.noty.js"></script>
        <script type="text/javascript" src="js/notyContainer.js"></script>
        
    </head>
    <body>
        <?php
        session_start();
        
        // Handle GET requests
        if (isset($_GET['createUser'])) {
            echo '<script type="text/javascript">successCreateUser()</script>';
        }
        
        // Process user registration
        if (isset($_POST['regUsername'])){
            if(strlen($_POST['regUsername']) < 1 ) {
                include 'login_form.php';
                include 'register_form.php';       
                echo '<script type="text/javascript">errorUsername();</script>';
                die();
            }

            if(!isset($_POST['regPassword1']) || strlen($_POST['regPassword1']) < 4  ) {
                include 'login_form.php';
                include 'register_form.php';
                echo '<script type="text/javascript">errorPasswordNotLongEnough();</script>';
                die();
            }
            if(!isset($_POST['regPassword2']) || strlen($_POST['regPassword2']) < 4  ) {
                include 'login_form.php';
                include 'register_form.php';
                echo '<script type="text/javascript">errorPasswordDoNotMatch();</script>';
                die();
            }

            $username = $_POST['regUsername'];
            $password1 = md5( $_POST['regPassword1'] );
            $password2 = md5( $_POST['regPassword2'] );
            $picture = $_POST['picture'];

            if($password1 != $password2) {
                include 'login_form.php';
                include 'register_form.php';
                echo '<script type="text/javascript">errorPasswordDoNotMatch();</script>';
                die();
            }

            $result = Users::register($username, $password1, $picture);
            if ($result){
                header( 'Location: index.php?createUser=true' );
            }   
            else if (mysql_errno() == 1062){
                include 'login_form.php';
                include 'register_form.php';
                echo '<script type="text/javascript">errorUserAlreadyExist();</script>';
                die();
            }
        }
        
        // Process user login
        if (isset($_POST['username']) && isset($_POST['password'])){
            $username = $_REQUEST['username'];
            $password = md5($_REQUEST['password']);
            $login = Users::login($username, $password);           
            if(!$login) {
                echo '<script type="text/javascript">errorLogin();</script>';
            }
            else{
                $_SESSION['userID'] = Users::getUserID($username);
                $_SESSION['username'] = $username;
                $_SESSION['roomID'] = NULL;
                $_SESSION['chatID'] = null;
                header('Location: lobby.php?login=true');
            }            
        }
        
        // Show login and register form if no session
        if(!isset($_SESSION['username'])) {
            include 'login_form.php';
            include 'register_form.php';
        } 
        else {
            echo '</br><a href="logout.php">logout</a>';
            header( 'Location: lobby.php?login=true' );
        }
        ?>
    </body>
</html>
