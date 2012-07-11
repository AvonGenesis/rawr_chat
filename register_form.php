<link rel="stylesheet" type="text/css" href="CSS/registerForm.css"/>
<div id="registerForm">
    <form action="index.php" method="post">
        <div id="register">Register</div> 
        <div id="username">Username:<br/>
            <input id="username_input" type="text" name="regUsername" value="" placeholder="Enter your username here"/>
        </div>
        <div id="password">Password:<br/>
            <input id="password_input" type="password" name="regPassword1" value="" placeholder="Enter your password here"/>       
        </div>
        <div id="password">Password again:<br/>
            <input id="password_input" type="password" name="regPassword2" value="" placeholder="Enter your password here again"/>       
        </div>
        <div id="picture">Picture:</br>
            <img src="/images/1.png"/><input id="radio" type="radio" name="picture" value="1"/>
            <img src="/images/2.png"/><input id="radio" type="radio" name="picture" value="2"/>
            <img src="/images/3.png"/><input id="radio" type="radio" name="picture" value="3"/></br>
            <img src="/images/4.png"/><input id="radio" type="radio" name="picture" value="4"/>
            <img src="/images/5.png"/><input id="radio" type="radio" name="picture" value="5"/>
            <img src="/images/6.png"/><input id="radio" type="radio" name="picture" value="6"/></br>
        </div>
        <input id="submit" type="submit" value="Register" />
    </form>
</div>
