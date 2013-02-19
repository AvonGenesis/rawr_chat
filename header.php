<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RawrChat</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <style type="text/css">
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
        </style>
        <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.css">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="../assets/ico/favicon.png">
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="index.php">RawrChat</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <?php
                            if (!isset($_SESSION['sessuserID'])) {
                                ?>
                                <li <?php echo (basename($_SERVER['SCRIPT_FILENAME']) == 'register.php' ? 'class="active' : ''); ?>"><a href="register.php">Sign Up</a></li>
                                <li class="divider-vertical"></li>
                                <li <?php echo (basename($_SERVER['SCRIPT_FILENAME']) == 'login.php' ? 'class="active' : ''); ?>"><a href="login.php">Login</a></li>
                                <?php
                            } else {
                                ?>
                                <!-- User Dropdown Menu When Logged In -->
                                <li class="dropdown">
                                    <a href="#"
                                       class="dropdown-toggle"
                                       data-toggle="dropdown">
                                           <?php
                                           echo $_SESSION['sessnickname'];
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
                            <?php } ?>
                        </ul>
                        <ul class="nav">
                            <li class="divider-vertical"></li>
                            <li <?php echo (basename($_SERVER['SCRIPT_FILENAME']) == 'index.php' ? 'class="active' : ''); ?>"><a href="index.php">Home</a></li>
                            <li <?php echo (basename($_SERVER['SCRIPT_FILENAME']) == 'lobby.php' ? 'class="active' : ''); ?>"><a href="lobby.php">Chatrooms</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
