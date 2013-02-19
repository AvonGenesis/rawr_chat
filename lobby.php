<?php
require_once 'php/classes/users.class.php';
require_once 'php/classes/chatrooms.class.php';
@session_start();
if (!isset($_SESSION['sessuserID'])) {
    header('Location: index.php?login=false');
}
if (isset($_SESSION['sessuserID'])) {
    $roomID = $_SESSION['sessroomID'];
    $nickname = $_SESSION['sessnickname'];
    Chatrooms::postMessage($nickname . ' has left the chatroom.', $roomID);
    $_SESSION['sesschatID'] = null;
    Users::setRoomID(null);
}

if (isset($_POST['nickname'])) {
    echo Users::changeNickname($_SESSION['sessusername'], $_POST['nickname']);
}

if (isset($_POST['color'])) {
    echo Users::changeColor($_SESSION['sessusername'], $_POST['color']);
}

require_once 'header.php';
?>
<link rel="stylesheet" href="colorpicker/css/colorpicker.css" />
<style type="text/css">
            #chatBackground {
                background-image: url('images/background.png');
                background-size: 1px 45px;
                background-repeat:repeat-x;
                width:70%;
                border-style: solid;
                border-radius: 15px;
                border-width: 5px;
                border-color: #ffffff;
                height: 30px;
                font-size: 20px;
                padding-top: 10px;
                margin-left: 40px;
                position:relative;
                top: -55px;
                left: 75px;
            }
            .arrow {
                height: 22px;
                position: relative;
                float: left;
                right: 45px;
                z-index: 999;
                background-size: 1px 25px;
            }
        </style>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
            <div class="well well-small">
                <div class="row-fluid">
                    <div class="span6" style="border-right: 1px solid #e5e5e5;">
                        <form class="form-horizontal" action="lobby.php" method="post">
                            <fieldset>
                                <legend style="width: 95%;">Settings</legend>
                                <div id="chatExample" style="background-color: #000000; margin-bottom: 10px; padding: 10px; height: 58px; margin-left: 30px; width: 500px;">
                                    <div id="chatIcon" style="width: 58px; background-color: <?php echo '#' . $_SESSION['sesscolor'];?>"><img src="images/avatar.png"/></div>
                                    <div id="chatBackground" style="background-color: <?php echo '#' . $_SESSION['sesscolor'];?>">
                                        <div style="color: #ffffff; text-align: center; padding-right: 55px;"><img class="arrow" src="images/arrow.png" style="background-image: url(images/background.png); background-color: <?php echo '#' . $_SESSION['sesscolor'];?>"/>TEXT GOES HERE</div>
                                    </div>
                                </div>
                                <br>
                                <div class="control-group">
                                    <label class="control-label" for="inputNickname">Nickname</label>
                                    <div class="controls">
                                        <input type="text" id="inputNickname" placeholder="Nickname" name="nickname"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="inputColor">Chat bubble color</label>
                                    <div class="controls">
                                        <div class="input-append color" data-color="<?php echo '#' . $_SESSION['sesscolor'];?>" id="colorpicker" data-color-format="hex">
                                            <input type="text" id="inputColor" class="span12" value="<?php echo '#' . $_SESSION['sesscolor'];?>" readonly name="color" />
                                            <span class="add-on"><i style="background-color: <?php echo '#' . $_SESSION['sesscolor'];?>"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>

                    <div class="span6">
                        <form class="form-horizontal" action="chatroom.php" method="post">
                            <fieldset>
                                <legend>Create Room</legend>
                                <div class="control-group">
                                    <label class="control-label" for="inputRoomname">Room Name</label>
                                    <div class="controls">
                                        <input type="text" id="inputRoomname" placeholder="Room Name" name="roomname"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="inputRoompassword">Room Password</label>
                                    <div class="controls">
                                        <input type="password" id="inputRoompassword" placeholder="Room Password" name="roompassword"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <?php
        require_once 'php/classes/chatrooms.class.php';
        Chatrooms::getChatroomListLobby();
        ?>
    </div>

    <hr>

    <footer>
        <p style="text-align: center;">Copyright &copy; 2012 <a href="http://www.juliantith.com/">Julian Tith</a> | <a href="https://github.com/AvonGenesis/rawr_chat">Source</a> | <a href="https://github.com/AvonGenesis/rawr_chat/issues">Bug Tracking</a></p>
    </footer>

</div>
<!-- Refresh Lobby Doesn't Work Anymore
<script type="text/javascript">
    $(document).ready(function(){
        //TODO: Don't forget to uncomment for lobby updates
        setInterval(loadLobby, 1000);
    });
</script>
-->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="colorpicker/js/bootstrap-colorpicker.js"></script>
<script>
    $(function(){
        $('#colorpicker').colorpicker({
            format: 'hex'
        });
                
        var chatStyle = $('#chatBackground')[0].style;
        $('#colorpicker').colorpicker().on('changeColor', function(ev){
            chatStyle.backgroundColor = ev.color.toHex();
        });
                
        var arrowStyle = $('.arrow')[0].style;
        $('#colorpicker').colorpicker().on('changeColor', function(ev){
            arrowStyle.backgroundColor = ev.color.toHex();
        });
                
        var iconStyle = $('#chatIcon')[0].style;
        $('#colorpicker').colorpicker().on('changeColor', function(ev){
            iconStyle.backgroundColor = ev.color.toHex();
        });
    });
</script>
</body>
</html>