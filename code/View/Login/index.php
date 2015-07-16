<div id="login-wrap">

    <div id="login-buttons">
        <div class="btn-wrap">
            <button type="button" class="btn" data-target="#login-form"><i class="icon-key"></i></button>
        </div>
        <div class="btn-wrap">
            <button type="button" class="btn" data-target="#register-form"><i class="icon-edit"></i></button>
        </div>
    </div>

    <div id="login-inner">

        <div id="login-circle">
            <section id="login-form" class="login-inner-form active" data-angle="0">
                <h1>Login</h1>
                <form class="form-vertical" action="/" method="post">
                    <div class="control-group<?php if(isset($this->_pars['login_error'])):?> error<?php endif; ?>">
                        <?php if(isset($this->_pars['login_error'])):?><label class="control-label" for="input-username">Логин или пароль неверны</label><?php endif; ?>
                        <input type="text" placeholder="Login" id="input-username" name="login" class="big"<?php if (isset($_POST['login'])):?> value="<?php echo $_POST['login']; ?>"<?php endif; ?>>
                        <input type="password" placeholder="Password" id="input-password" name="password" class="big">
                    </div>
                    <div class="control-group">
                        <label class="checkbox">
                            <input type="checkbox" class="uniform" name="remember"> Запомнить меня
                        </label>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-info btn-block btn-large">Login</button>
                    </div>
                </form>

            </section>
            <section id="register-form" class="login-inner-form" data-angle="90">
                <h1>Регистрация</h1>
                <form class="form-vertical" action="dashboard.html">
                    <div class="control-group">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input type="text">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Password</label>
                        <div class="controls">
                            <input type="password">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Fullname</label>
                        <div class="controls">
                            <input type="text">
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning btn-block btn-large">Регистрация</button>
                    </div>
                </form>
            </section>
        </div>

    </div>

</div>
