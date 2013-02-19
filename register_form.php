<link rel="stylesheet" href="colorpicker/css/colorpicker.css" />
<style type="text/css">
#chatBackground {
    background-image: url('images/background.png');
    background-size: 1px 40px;
    background-repeat:repeat-x;
    width:80%;
    border-style: solid;
    border-radius: 15px;
    border-width: 5px;
    border-color: #ffffff;
    height: 30px;
    font-size: 20px;
    padding-top: 10px;
    position:relative;
    top: -55px;
    left: 75px;
}
</style>
<div class="container-fluid">
    <form action="" method="post" class="form-horizontal" id="register">
        <fieldset>
            <legend>Sign Up</legend>
            <div class="control-group">
                <label class="control-label" for="input0">Username</label>
                <div class="controls">
                    <input type="text" class="input-xlarge" id="username" name="username" />
                    <p class="help-block">This is your username that will be used to login.</p>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="input0">Nickname</label>
                <div class="controls">
                    <input type="text" class="input-xlarge" id="nickname" name="nickname" />
                    <p class="help-block">This will be your display name throughout the site. This can be changed later.</p>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="input0">Password</label>
                <div class="controls">
                    <input type="password" class="input-xlarge" id="password1" name="password1" />
                    <p class="help-block">Must be at least 6 characters long.</p>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="input0">Verify Password</label>
                <div class="controls">
                    <input type="password" class="input-xlarge" id="password2" name="password2" />
                </div>
            </div>
            <!--  Bootstrap Javascript Icons
                <div class="btn-group" data-toggle="buttons-radio">
                    <button class="btn"><img src="/images/1.png"/></button>
                    <button class="btn"><img src="/images/2.png"/></button>
                    <button class="btn"><img src="/images/3.png"/></button>
                    <button class="btn"><img src="/images/4.png"/></button>
                    <button class="btn"><img src="/images/5.png"/></button>
                    <button class="btn"><img src="/images/6.png"/></button>
                </div>
            -->
            <div class="control-group">
                <label class="control-label" for="input0">Chat bubble color</label>
                <div class="controls">
                    <div class="input-append color" data-color="#255AA8" id="colorpicker" data-color-format="hex">
                        <input type="text" class="span2" value="#255AA8" readonly name="color" />
                        <span class="add-on"><i style="background-color: #255AA8"></i></span>
                    </div>
                    <p class="help-block">Pick a color for your chat bubble. This can be changed later.</p>
                </div>
            </div>
            <div id="chatExample" style="background-color: #000000; margin-bottom: 10px; padding: 10px; height: 58px; margin-left: 30px; width: 435px;">
                <div id="chatIcon" style="width: 58px; background-color: #255AA8;"><img src="images/avatar.png"/></div>
                <div id="chatBackground" style="background-color: #255AA8;">
                    <div style="color: #ffffff"><center>TEXT GOES HERE</center></div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Sign Up</button>
                <button class="btn">Cancel</button>
            </div>
        </fieldset>
    </form>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
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
        
        var iconStyle = $('#chatIcon')[0].style;
        $('#colorpicker').colorpicker().on('changeColor', function(ev){
            iconStyle.backgroundColor = ev.color.toHex();
        });
    });
</script>
<script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.min.js"></script>
<script>
    $(document).ready(function()
    {
        $("#register").validate({
            rules:{
                username:{required:true,minlength: 4},
                nickname:{required:true},
                colorpicker:{required:true,minlength: 7},
                password1:{required:true,minlength: 6},
                password2:{required:true,minlength: 6, equalTo:"#password1"}
            },

            messages:{
                username:{
                    required:"Enter your username",
                    minlength:"Username must be minimum 4 characters"},
                nickname:{
                    required:"Enter your nickname"},
                colorpicker:{
                    required:"Select a color",
                    minlength:"Color must be at least 6 characters long"},
                password1:{
                    required:"Enter your password",
                    minlength:"Password must be minimum 6 characters"},
                password2:{
                    required:"Enter confirm password",
                    minlength:"Password must be minimum 6 characters",
                    equalTo:"Password and Confirm Password must match"}
            },

            errorClass: "help-inline",
            errorElement: "span",
            highlight:function(element, errorClass, validClass)
            {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass)
            {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
        });
    });
</script>
</body>
</html>