<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

use app\lib\Controllers\UsersController;

$getParams = $_GET;

if ($getParams['logout']) {
    $usersController = new UsersController();
    $usersController->logout($getParams);
}

if (
    empty($_SESSION['auth_user'])
    && strpos($_SERVER['REQUEST_URI'], 'login.php') === false
    && strpos($_SERVER['REQUEST_URI'], 'registration.php') === false
) {
    header("Location: /view/login.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Моя тестовая страница</title>
    <link rel="stylesheet" type="text/css" href="/src/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/src/style/app.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light bg-light w-100">
                <div class="collapse navbar-collapse menu-container justify-content-between" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Анкета</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/view/friends.php">Мои друзья</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/view/all_users.php">Все пользователи</a>
                        </li>
                    </ul>
                    <span class="navbar-text">
                        <ul class="navbar-nav mr-auto">
                            <?php if (!$_SESSION['auth_user']) { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="/view/login.php">Вход</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/view/registration.php">Регистрация</a>
                                </li>
                            <?php } else { ?>
                                <li class="nav-item d-flex align-items-center"><?= $_SESSION['auth_user']['first_name'] ?></li>
                                <li class="nav-item">
                                    <a class="nav-link" href="?logout=yes">Выход</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </span>
                </div>
            </nav>


