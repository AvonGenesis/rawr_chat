<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rawr Chat</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.css">
        <!-- <script src="bootstrap/js/jquery.js"></script> -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.js"></script>
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="index.php">Rawr Chat</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                            <?php
                            @session_start();
                            if (isset($_SESSION['userID'])) {
                            ?>
                            <li><a href="lobby.php">View Rooms</a></li>
                            <li class="dropdown">
                                <a href="#"
                                   class="dropdown-toggle"
                                   data-toggle="dropdown">
                                    Create Room
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
                                    <form action="chatroom.php" method="post">
                                        <label style="color:#000000">Room Name</label>
                                        <input id="username_input" type="text" name="roomname" size="30"/>
                                        <button type="submit" id="submit" class="btn btn-primary" style="width:100%; margin:0px;">Create</button>
                                    </form>
                                </ul>
                            </li>
                            <?php
                            }
                            require_once ('php/db/users.class.php');
                            if (isset($_SESSION['roomID'])) {
                            $roomID = $_SESSION['roomID'];
                            if (Users::isRoomAdmin($roomID)) {
                            ?>
                            <li class="dropdown">
                                <a href="#"
                                   class="dropdown-toggle"
                                   data-toggle="dropdown">
                                    Room Control
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
                                    <form action="chatroom.php" method="post">
                                        <input type="hidden" name="roomID" value="<?php echo $roomID; ?>"/>
                                        <input type="hidden" name="delete"/>
                                        <button type="submit" id="submit" class="btn btn-danger" style="width:100%; margin:0px;">Delete Room</button>
                                    </form>
                                </ul>
                            </li>
                            <?php
                            }
                            }
                            ?>
                        </ul>
                        <ul class="nav pull-right">
                            <?php
                            if (!isset($_SESSION['userID'])) {
                            ?>
                            <li><a href="signup.php">Sign Up</a></li>
                            <li class="divider-vertical"></li>
                            <li class="dropdown">
                                <a href="#"
                                   class="dropdown-toggle"
                                   data-toggle="dropdown">
                                    Login
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
                                    <form action="index.php" method="post">
                                        <label style="color:#000000">Username</label>
                                        <input id="username_input" type="text" name="username" size="30"/>
                                        <label style="color:#000000">Password</label>
                                        <input id="password_input" type="password" name="password" size="30"/>
                                        <input id="user_remember_me" style="float: left; margin-right: 10px;" type="checkbox" name="user[remember_me]" value="1" />
                                        <label class="string optional" for="user_remember_me"> Remember me</label>
                                        <button type="submit" id="submit" class="btn btn-primary" style="width:100%; margin:0px;">Sign In</button>
                                    </form>
                                </ul>
                            </li>
                            <?php
                            } else {
                            ?>
                            <li class="dropdown">
                                <a href="#"
                                   class="dropdown-toggle"
                                   data-toggle="dropdown">
                                    <?php 
                                    echo $_SESSION['nickname'];
                                    ?>
                                    <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="settings.php">Settings</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="logout.php">Sign Out</a>
                                    </li>
                                </ul>
                            </li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
