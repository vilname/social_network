<?php
include_once "./view/header.php";

use app\lib\Controllers\UsersController;

$usersController = new UsersController();
$user = $usersController->getUser($_SESSION['auth_user']['login']);

?>

<a href="/view/edit.php" class="btn btn-info m-3">Редактировать</a>
<div class="list-group w-100">
    <div class="list-group-item">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Логин</h5>
        </div>
        <p class="mb-1"><?= $user->getLogin() ?></p>
    </div>
</div>
<div class="list-group w-100">
    <div class="list-group-item">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Имя</h5>
        </div>
        <p class="mb-1"><?= $user->getFirstName() ?></p>
    </div>
</div>
<div class="list-group w-100">
    <div class="list-group-item">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Фамилия</h5>
        </div>
        <p class="mb-1"><?= $user->getSurName() ?></p>
    </div>
</div>
<div class="list-group w-100">
    <div class="list-group-item">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Возраст</h5>
        </div>
        <p class="mb-1"><?= $user->getAge() ?></p>
    </div>
</div>
<div class="list-group w-100">
    <div class="list-group-item">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Город</h5>
        </div>
        <p class="mb-1"><?= $user->getCity() ?></p>
    </div>
</div>
<div class="list-group w-100">
    <div class="list-group-item">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">Интересы</h5>
        </div>
        <p class="mb-1"><?= $user->getInterest() ?></p>
    </div>
</div>
