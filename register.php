<style>
    #error {
        text-align: center;
        margin-left: auto;
        margin-right: auto;
        padding: 3px;
        width: 200px;
        color:#ffffff;
        background-color:#ff0000;
        border-color:#ff9999;
        border-width: 2px;
    }
    #success {
        text-align: center;
        margin-left: auto;
        margin-right: auto;
        padding: 3px;
        width: 200px;
        color:#ffffff;
        background-color:#00cc33;
        border-color:#66ccff;
        border-width: 2px;
    }
</style>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
   setTimeout(function(){
      $("#error").fadeOut("slow") //#popupBox is the DIV to fade out
   }, 5000); //5000 equals 5 seconds
});
</script>

<?php
    require_once 'PHP/DB/users.class.php';

    
    try {
        if(!isset($_REQUEST['username']) || strlen($_REQUEST['username']) < 1 ) {        
            throw new Exception('Please enter a username');
        }
        if(!isset($_REQUEST['password1']) || strlen($_REQUEST['password1']) < 4  ) {
            throw new Exception('Invalid password, must be 4 characters');
        }
        if(!isset($_REQUEST['password2']) || strlen($_REQUEST['password2']) < 4  ) {
            throw new Exception('Invalid password, must be 4 characters');
        }

        $username = $_REQUEST['username'];
        $password1 = md5( $_REQUEST['password1'] );
        $password2 = md5( $_REQUEST['password2'] );       

        if($password1 != $password2) {
            throw new Exception('passwords do not match!');
        }

        $result = Users::register($username, $password1);
        if ($result){
            echo '<div id="success">Success user has been created!</div>';
            echo '<a href="index.php">Log in now!</a>';
        }   
    }
    catch (Exception $e) 
    {
        echo '<div id="error">' . $e->getMessage() . '</div>';
        include 'register_form.php';
    }
?>