<?php
require_once 'php/classes/users.class.php';
require_once 'php/classes/chatrooms.class.php';

@session_start();
if (isset($_SESSION['sessuserID'])) {
    $roomID = $_SESSION['sessroomID'];
    $nickname = $_SESSION['sessnickname'];
    Chatrooms::postMessage($nickname . ' has left the chatroom.', $roomID);
    $_SESSION['sesschatID'] = null;
    Users::setRoomID(null);
}

// Process user login
if (isset($_POST['username']) && isset($_POST['password'])) {
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
    }
}

require_once 'header.php';

if (isset($_GET['login'])) {
    echo '<div class="container alert alert-error fade in">
    <button class="close" data-dismiss="alert">&times;</button>
    You must first register or sign in to view that page.
    </div>';
}

if (isset($_GET['register'])) {
    echo '<div class="container alert alert-success fade in">
    <button class="close" data-dismiss="alert">&times;</button>
    Congratulations! You may now sign in.
    </div>';
}

if (isset($_GET['logout'])) {
    echo '<div class="container alert alert-success fade in">
    <button class="close" data-dismiss="alert">&times;</button>
    You have successfully signed out.
    </div>';
}
?>
<link href="css/index.css" rel="stylesheet">
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="well well-small" style="background-color: #000000;">
                <div id="myCarousel" class="carousel slide" style="margin-bottom: 0px;">
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <div class="active item"><dl><dt><img src="images/avatar.png" style="background-color: red;"/><br>TEST NAME</dt><dd style="background-color: red; background-image: url(images/background.png);"><img class="arrow" src="images/arrow.png" style="background-image: url(images/background.png); background-color: red;"/>the decorpsinator serum is working! No, this is wrong. Theyre not coming back to life theyre still</dd></dl></div>
                        <div class="item"><dl><dt><img src="images/avatar.png" style="background-color: blue;"/><br>TEST NAME</dt><dd style="background-color: blue; background-image: url(images/background.png);"><img class="arrow" src="images/arrow.png" style="background-image: url(images/background.png); background-color: blue;"/>the decorpsinator serum is working! No, this is wrong. Theyre not coming back to life theyre still</dd></dl></div>
                        <div class="item"><dl><dt><img src="images/avatar.png" style="background-color: white;"/><br>TEST NAME</dt><dd style="background-color: white; background-image: url(images/background.png);"><img class="arrow" src="images/arrow.png" style="background-image: url(images/background.png); background-color: white;"/>the decorpsinator serum is working! No, this is wrong. Theyre not coming back to life theyre still</dd></dl></div>
                        <div class="item"><dl><dt><img src="images/avatar.png" style="background-color: black;"/><br>TEST NAME</dt><dd style="background-color: black; background-image: url(images/background.png);"><img class="arrow" src="images/arrow.png" style="background-image: url(images/background.png); background-color: black;"/>the decorpsinator serum is working! No, this is wrong. Theyre not coming back to life theyre still</dd></dl></div>
                        <div class="item"><dl><dt><img src="images/avatar.png" style="background-color: orange;"/><br>TEST NAME</dt><dd style="background-color: orange; background-image: url(images/background.png);"><img class="arrow" src="images/arrow.png" style="background-image: url(images/background.png); background-color: orange;"/>the decorpsinator serum is working! No, this is wrong. Theyre not coming back to life theyre still</dd></dl></div>
                        <div class="item"><dl><dt><img src="images/avatar.png" style="background-color: green;"/><br>TEST NAME</dt><dd style="background-color: green; background-image: url(images/background.png);"><img class="arrow" src="images/arrow.png" style="background-image: url(images/background.png); background-color: green;"/>the decorpsinator serum is working! No, this is wrong. Theyre not coming back to life theyre still</dd></dl></div>
                        <div class="item"><dl><dt><img src="images/avatar.png" style="background-color: yellow;"/><br>TEST NAME</dt><dd style="background-color: yellow; background-image: url(images/background.png);"><img class="arrow" src="images/arrow.png" style="background-image: url(images/background.png); background-color: yellow;"/>the decorpsinator serum is working! No, this is wrong. Theyre not coming back to life theyre still</dd></dl></div>
                        <div class="item"><dl><dt><img src="images/avatar.png" style="background-color: purple;"/><br>TEST NAME</dt><dd style="background-color: purple; background-image: url(images/background.png);"><img class="arrow" src="images/arrow.png" style="background-image: url(images/background.png); background-color: purple;"/>the decorpsinator serum is working! No, this is wrong. Theyre not coming back to life theyre still</dd></dl></div>
                    </div>
                    <!-- Carousel nav -->
                    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span6" style="border-right: 1px solid #eeeeee;">
                    <!-- TODO: Dynamic News -->
                    <h2>News</h2>
                    <div style="padding-right: 20px;">
                        <h3>Minor Update</h3>
                        <h5><small>February 16, 2013</small></h5>
                        <p>Whats New:</p>
                        <ul>
                            <li>Added a settings panel to the lobby page.</li>
                        </ul>
                        <p>Fixes:</p>
                        <ul>
                            <li>Some pages telling you to login even though you are.</li>
                            <li>Some grammar tweaks.</li>
                        </ul>
                        
                        <hr>
                        
                        <h3>Homepage Update and More!</h3>
                        <h5><small>February 10, 2013</small></h5>
                        <p>Whats New:</p>
                        <ul>
                            <li><strike>Chat carousel displaying live messages from front page chatroom</strike>  I broke it.</li>
                            <li>Added a section for news on the homepage.</li>
                            <li>Added a section for viewing the chatroom list.</li>
                        </ul>
                        <p>Changes:</p>
                        <ul>
                            <li>No longer need to be logged in to view chatroom lobby list.</li>
                            <li>Dropdown menu for login is removed, it now redirects to a login page.</li>
                        </ul>
                        
                        <hr>

                        <h3>Site Update</h3>
                        <h5><small>November 09, 2012</small></h5>
                        <p>Whats New:</p>
                        <ul>
                            <li>Added restricted nickname list. Nicknames that contains words on this list are unavailable.</li>
                            <li>Added custom background color for avatar and chat.</li>
                            <li>Using crypt() instead of md5() for password hashing.</li>
                        </ul>
                    </div></div>
                <div class="span6">
                    <h2>Chatrooms</h2>
                    <?php
                    require_once 'php/classes/chatrooms.class.php';
                    Chatrooms::getChatroomListFrontpage();
                    ?>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <footer>
        <p style="text-align: center;">Copyright &copy; 2012 <a href="http://www.juliantith.com/">Julian Tith</a> | <a href="https://github.com/AvonGenesis/rawr_chat">Source</a> | <a href="https://github.com/AvonGenesis/rawr_chat/issues">Bug Tracking</a></p>
    </footer>

</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.carousel').carousel({
            interval: 2500
        })
    });
</script>
<script src="bootstrap/js/bootstrap.js"></script>
</body>
</html>