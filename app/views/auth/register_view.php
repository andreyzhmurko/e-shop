<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <?php if ($this->user): ?>
                    <p>Вы зарегистрированы!</p>
                <?php else: ?>
                    <?php if (isset($this->errors) && is_array($this->errors)): ?>
                        <ul>
                            <?php foreach ($this->errors as $error): ?>
                                <li> - <?= $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <div class="signup-form"><!--sign up form-->
                        <h2>Регистрация нового пользователя!</h2>
                        <form action="/user/register/" method="POST">
                            <input type="text" placeholder="Имя" name="name" value="<?= $this->name; ?>"/>
                            <input type="email" placeholder="E-mail" name="email" value="<?= $this->email; ?>"/>
                            <input type="password" placeholder="Пароль" name="password"/>
                            <input type="password" placeholder="Подтвердите пароль" name="password_confirm""/>
                            <button type="submit" name="submit" class="btn btn-default">Зарегистрироваться</button>
                        </form>
                    </div><!--/sign up form-->
                <?php endif; ?>
            </div>
        </div>
    </div>
</section><!--/form-->