<link rel="stylesheet" type="text/css" href="CSS/base.css"/>
<link rel="stylesheet" type="text/css" href="CSS/registerForm.css"/>

<div id="registerForm">
    <form action="register.php" method="post">
        <div id="register">Register</div> 
        <div id="username">Username:<br/>
        <input id="username_input" type="text" name="username" value="" placeholder="Enter your username here"/>
            </div>
        <div id="password">Password:<br/>
        <input id="password_input" type="password" name="password1" value="" placeholder="Enter your password here"/>       
        </div>
        <div id="password">Password again:<br/>
        <input id="password_input" type="password" name="password2" value="" placeholder="Enter your password here again"/>       
        </div>
        <input id="submit" type="submit" value="Register" />
    </form>
</div>