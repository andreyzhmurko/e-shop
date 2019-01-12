<section>
    <div class="container">
        <div class="row">

            <h3>Кабинет пользователя</h3>

            <?php foreach ($this->user as $user): ?>
                <h4>Добро пожаловать, <?= $user['name']; ?>!</h4>
            <?php endforeach; ?>
            <ul>
                <li><a href="/cabinet/edit/">Редактировать данные</a></li>
            </ul>

        </div>
    </div>
</section>

