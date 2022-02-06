<?php
include_once "header.php";

use app\lib\Controllers\UsersController;

if (!empty($_POST)) {
    $usersController = new UsersController();
    $answerLogin = $usersController->login();
}

if ($_SESSION['auth_user']) {
    header("Location: /");
}

?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="w-100">
                <?php if ($answerLogin['success']) { ?>
                    <div v-if="success" class="alert alert-success" role="alert">
                        <?= $answerLogin['success'] ?>
                    </div>
                <?php } ?>
                <?php if ($answerLogin['error']) { ?>
                    <div v-if="error" class="alert alert-danger" role="alert">
                        <?= $answerLogin['error'] ?>
                    </div>
                <?php } ?>
                <h2 class="text-center">Авторизация</h2>
                <form class="col-6" method="post">
                    <div class="form-group mb-2">
                        <label for="loginInput">Логин</label>
                        <input type="text" name="login" class="form-control" id="loginInput" placeholder="Логин">
                    </div>
                    <div class="form-group mb-2">
                        <label for="exampleInputPassword1">Пароль</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Пароль">
                    </div>
                    <div class="form-check mb-2">
                        <input type="checkbox" name="check" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Запоминть меня</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </form>
            </div>
        </div>
    </div>

<?php
include_once "footer.php";

