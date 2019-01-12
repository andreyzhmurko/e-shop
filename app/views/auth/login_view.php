<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <?php if (isset($this->errors) && is_array($this->errors)): ?>
                    <ul>
                        <?php foreach ($this->errors as $error): ?>
                            <li> - <?= $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <div class="login-form"><!--login form-->
                    <h2>Вход в свой аккаунт</h2>
                    <form action="/user/login/" method="post">
                        <input type="text" placeholder="E-mail" name="email" value="<?= $this->email; ?>"/>
                        <input type="password" placeholder="Пароль" name="password"/>
                        <button type="submit" name="submit" class="btn btn-default">Войти</button><br/>
                        или
                        <a href="/user/register/">Зарегистрироваться</a>
                    </form>
                </div><!--/login form-->
            </div>
        </div>
    </div>
</section><!--/form-->
