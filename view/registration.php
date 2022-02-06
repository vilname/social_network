<?php
include_once "header.php";

use app\lib\Controllers\UsersController;

if (!empty($_POST)) {
    $usersController = new UsersController();
    $answerRegistration = $usersController->registration();
}

?>
<div class="container">
    <div class="row">
        <div class="w-100">
            <?php if ($answerRegistration['success']) { ?>
                <div v-if="success" class="alert alert-success" role="alert">
                    <?= $answerRegistration['success'] ?>
                </div>
            <?php } ?>
            <?php if ($answerRegistration['error']) { ?>
                <div v-if="error" class="alert alert-danger" role="alert">
                    <?= $answerRegistration['error'] ?>
                </div>
            <?php } ?>
            <h2 class="text-center">Регистрация</h2>
            <form class="col-6" method="post">
                <div class="form-group mb-2">
                    <label for="loginInput">Логин</label>
                    <input type="text" name="login" class="form-control" id="loginInput" placeholder="Логин">
                </div>
                <div class="form-group mb-2">
                    <label for="exampleInputPassword">Пароль</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword" placeholder="Пароль">
                </div>
                <div class="form-group mb-2">
                    <label for="nameInput">Имя</label>
                    <input type="text" name="first_name" class="form-control" id="nameInput" placeholder="Имя">
                </div>
                <div class="form-group mb-2">
                    <label for="surNameInput">Фамилия</label>
                    <input type="text" name="sur_name" class="form-control" id="surNameInput" placeholder="Фамилия">
                </div>
                <div class="form-group mb-2">
                    <label for="ageInput">Возраст</label>
                    <input type="number" name="age" class="form-control" id="ageInput" placeholder="Возраст">
                </div>
                <div class="form-group mb-2">
                    <label for="cityInput">Город</label>
                    <input type="text" name="city" class="form-control" id="cityInput" placeholder="Город">
                </div>
                <div class="form-group mb-2">
                    <label for="interestsTextarea">Интересы</label>
                    <textarea class="form-control" name="interest" id="interestsTextarea"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Зарегистрировать</button>
            </form>
        </div>
    </div>
</div>

<?php

include_once "footer.php";
