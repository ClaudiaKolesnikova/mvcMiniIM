<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <?php if(isset($_SESSION['regUserId'])):?>
            <h1 class="text-center">
                Вы успешно зарегистрированы!!!
            </h1>
            <?php unset($_SESSION['regUserId'])?>
            <?php endif;?>
            <h2>Кабинет пользователя</h2>
            
            <h3>Привет, <?= $user['name'];?>!</h3>
            <ul>
                <li><a href="/cabinet/edit">Редактировать данные</a></li>
            </ul>
            
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>