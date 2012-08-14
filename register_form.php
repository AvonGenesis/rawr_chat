<link rel="stylesheet" href="colorpicker/css/colorpicker.css" />
<div class="container">
    <form action="" method="post" class="form-horizontal">
        <fieldset>
            <legend>Sign Up</legend>
            <div class="control-group">
                <label class="control-label" for="username">Username</label>
                <div class="controls">
                    <input type="text" class="input-xlarge" id="username" name="username" />
                    <p class="help-block">This will be your display name throughout the site.</p>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="password1">Password</label>
                <div class="controls">
                    <input type="password" class="input-xlarge" id="password1" name="password1" />
                    <p class="help-block">Must be at least 4 characters long.</p>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="password2">Verify Password</label>
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
                <label class="control-label" for="colorpicker">Chat bubble color</label>
                <div class="controls">
                    <div class="input-append color" data-color="#53998C" id="colorpicker" data-color-format="hex">
                        <input type="text" class="span2" value="" readonly name="color" />
                        <span class="add-on"><i style="background-color: #53998C"></i></span>
                    </div>
                    <p class="help-block">Pick a color for your chat bubble, this can be changed later in the settings.</p>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Avatar</label>
                <div class="controls">
                    <label class="radio">
                    <input type="radio" name="avatar" value="1" />
                    <img src="/images/1.png" />
                    </label>
                    <label class="radio">
                    <input type="radio" name="avatar" value="2" />
                    <img src="/images/2.png" />
                    </label>
                    <label class="radio">
                    <input type="radio" name="avatar" value="3" />
                    <img src="/images/3.png" />
                    </label>
                    <label class="radio">
                    <input type="radio" name="avatar" value="4" />
                    <img src="/images/4.png" />
                    </label>
                    <label class="radio">
                    <input type="radio" name="avatar" value="5" />
                    <img src="/images/5.png" />
                    </label>
                    <label class="radio">
                    <input type="radio" name="avatar" value="6" />
                    <img src="/images/6.png" />
                    </label>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Sign Up</button>
                <button class="btn">Cancel</button>
            </div>
        </fieldset>
    </form>
</div>
<script src="colorpicker/js/bootstrap-colorpicker.js"></script>
<script>
    $(function(){
        $('#colorpicker').colorpicker({
            format: 'hex'
        });
    });
</script>