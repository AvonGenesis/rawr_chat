<?php
require_once 'php/classes/users.class.php';
require_once 'php/classes/chatrooms.class.php';

@session_start();
if (isset($_SESSION['sessuserID'])) {
    $roomID   = $_SESSION['sessroomID'];
    $nickname = $_SESSION['sessnickname'];
    Chatrooms::postMessage($nickname . ' has left the chatroom.', $roomID);
    $_SESSION['sesschatID'] = null;
    Users::setRoomID(null);
}

// Process user login
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $login    = Users::login($username, $password);
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
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span2"></div>
        <div class="span8">
            <h1>Hipster Ipsum!</h1>
            <p>Narwhal cosby sweater scenester gentrify, you probably haven't heard of them selvage chambray pitchfork polaroid post-ironic. Art party pickled wes anderson brooklyn. Artisan vegan DIY chambray, echo park mcsweeney's pickled kogi beard brunch. Austin helvetica typewriter, mcsweeney's skateboard keytar kogi brunch readymade. Wolf cosby sweater mustache, bespoke twee tumblr odd future marfa salvia readymade ethnic umami bushwick organic. Retro mixtape carles bushwick cred, tofu godard. Echo park fap ethical, etsy freegan art party helvetica retro craft beer pop-up.</p>
            <p>Yr cardigan twee, typewriter leggings american apparel umami banh mi cosby sweater pinterest quinoa raw denim polaroid forage art party. Cliche brunch helvetica pop-up street art, mustache keytar. Aesthetic fap brooklyn, pitchfork cardigan portland synth skateboard before they sold out keffiyeh. Viral swag ethnic jean shorts biodiesel skateboard yr, shoreditch twee cosby sweater Austin vegan salvia terry richardson mustache. Gentrify readymade mumblecore etsy williamsburg. Scenester small batch synth typewriter carles, gastropub lomo single-origin coffee flexitarian you probably haven't heard of them portland stumptown williamsburg helvetica lo-fi. Ennui Austin wes anderson mcsweeney's swag, semiotics ethnic DIY.</p>
            <p>Mumblecore post-ironic tofu cred. Yr lomo beard mustache DIY kale chips, flexitarian post-ironic pour-over bespoke. Pinterest seitan umami, wayfarers williamsburg 8-bit marfa swag gentrify. Terry richardson butcher portland master cleanse. Williamsburg selvage sustainable wolf, occupy ethnic swag kogi dreamcatcher godard wayfarers. Before they sold out ennui gentrify sustainable next level freegan. Gastropub vinyl seitan before they sold out marfa skateboard.</p>
            <p>Bicycle rights authentic stumptown, small batch pop-up tumblr cred. Pitchfork tofu chillwave occupy flexitarian master cleanse, biodiesel tattooed freegan godard art party viral twee salvia. Thundercats readymade keytar, pitchfork mumblecore mixtape marfa brunch biodiesel master cleanse retro small batch odd future chambray. Gentrify messenger bag leggings, wes anderson skateboard cray selvage umami bicycle rights narwhal swag DIY sustainable. Viral hella whatever synth pickled. Flexitarian cardigan trust fund chillwave, thundercats scenester sartorial mustache. PBR cardigan readymade, seitan vegan bicycle rights marfa wes anderson thundercats photo booth tattooed chambray fingerstache banh mi VHS.</p>
        </div>
        <div class="span2"></div>
    </div>
</div>
<?php
require_once 'footer.php';
?>
