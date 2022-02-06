<?php
include_once "header.php";

use app\lib\Controllers\UsersController;

$usersController = new UsersController();
if (!empty($_POST)) {
    $editProfile = $usersController->editProfile($_POST);
}

$user = $usersController->getUser($_SESSION['auth_user']['login']);
?>

    <div class="container">
        <div class="row">
            <div class="w-100">
                <?php if ($editProfile['success']) { ?>
                    <div v-if="success" class="alert alert-success" role="alert">
                        <?= $editProfile['success'] ?>
                    </div>
                <?php } ?>
                <?php if ($editProfile['error']) { ?>
                    <div v-if="error" class="alert alert-danger" role="alert">
                        <?= $editProfile['error'] ?>
                    </div>
                <?php } ?>
                <h2 class="text-center">Изменение анкеты</h2>
                <form class="col-6" method="post">
                    <div class="form-group mb-2">
                        <label for="loginInput">Логин</label>
                        <input
                            type="text"
                            name="login"
                            class="form-control"
                            id="loginInput"
                            placeholder="Логин"
                            value="<?=$user->getLogin()?>"
                        >
                    </div>
                    <div class="form-group mb-2">
                        <label for="nameInput">Имя</label>
                        <input
                            type="text"
                            name="first_name"
                            class="form-control"
                            id="nameInput"
                            placeholder="Имя"
                            value="<?=$user->getFirstName()?>"
                        >
                    </div>
                    <div class="form-group mb-2">
                        <label for="surNameInput">Фамилия</label>
                        <input
                            type="text"
                            name="sur_name"
                            class="form-control"
                            id="surNameInput"
                            placeholder="Фамилия"
                            value="<?=$user->getSurName()?>"
                        >
                    </div>
                    <div class="form-group mb-2">
                        <label for="ageInput">Возраст</label>
                        <input
                            type="number"
                            name="age"
                            class="form-control"
                            id="ageInput"
                            placeholder="Возраст"
                            value="<?=$user->getAge()?>"
                        >
                    </div>
                    <div class="form-group mb-2">
                        <label for="cityInput">Город</label>
                        <input
                            type="text"
                            name="city"
                            class="form-control"
                            id="cityInput"
                            placeholder="Город"
                            value="<?=$user->getCity()?>"
                        >
                    </div>
                    <div class="form-group mb-2">
                        <label for="interestsTextarea">Интересы</label>
                        <textarea class="form-control" name="interest" id="interestsTextarea"><?=$user->getInterest()?></textarea>
                    </div>
                    <input type="hidden" name="id" value="<?=$user->getId()?>">
                    <button type="submit" class="btn btn-primary">Изменить</button>
                </form>
            </div>
        </div>
    </div>

<?php

include_once "footer.php";
