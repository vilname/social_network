<?php
include_once "header.php";

use app\lib\Controllers\UsersController;
use app\lib\Repository\User\Model\UsersModel;

$getParams = $_GET;
if ($getParams['change_friend']) {
    $friendController = new \app\lib\Controllers\FriendsController();
    $friendController->changeStatusFriend($getParams['change_friend'], $_SESSION['auth_user']['id']);
}

$usersController = new UsersController();
$searchUsers = null;
$name = $_POST['search-name'] . '%' ?? '';
$surName = $_POST['search-surname'] . '%' ?? '';
if ($_POST['search-name'] || $_POST['search-surname']) {
    $searchUsers = $usersController->searchFriends($name, $surName);
}

$usersController = new UsersController();
$users = $usersController->getOtherUsers($searchUsers);



/** @var UsersModel $user */
?>

<form class="form-group mt-2 mb-2" name="search" method="post">
    <div class="form-group">
        <label for="search-name">Имя</label>
        <input type="text" class="form-control search--input" name="search-name" id="search-name" placeholder="Имя" value="<?= $name ?>">
    </div>
    <div class="form-group">
        <label for="search-surname">Фамилия</label>
        <input type="text" class="form-control" id="search-surname" placeholder="Фамилия" value="<?= $surName ?>">
    </div>

    <button type="submit" class="btn btn-primary mb-2">Поиск</button>
</form>

<div class="list-group w-100" id="list-tab" role="tablist">
    <?php foreach ($users as $user) { ?>
    <a href="?change_friend=<?= $user->getId() ?>" class="list-group-item list-group-item-action btn d-flex justify-content-between">
        <?=$user->getSurName() . ' ' . $user->getFirstName() ?>
        <span class="badge badge-primary badge-pill"><?= !empty($user->getFriends()->getUserId()) ? 'в друзьях' : 'не в друзьях' ?></span>
    </a>
    <?php } ?>
</div>
