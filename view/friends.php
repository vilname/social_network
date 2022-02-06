<?php
include_once "header.php";

use app\lib\Controllers\UsersController;
use app\lib\Repository\User\Model\UsersModel;
use app\lib\Controllers\FriendsController;

$getParams = $_GET;
if ($getParams['change_friend']) {
    $friendController = new FriendsController();
    $friendController->changeStatusFriend($getParams['change_friend'], $_SESSION['auth_user']['id']);
}

$usersController = new UsersController();
$users = $usersController->getFriends($_SESSION['auth_user']['id']);

/** @var UsersModel $user */
?>

<div class="list-group w-100" id="list-tab" role="tablist">
    <?php foreach ($users as $user) { ?>
        <a href="?change_friend=<?= $user->getId() ?>" class="list-group-item list-group-item-action btn d-flex justify-content-between">
            <?=$user->getSurName() . ' ' . $user->getFirstName() ?>
            <span class="badge badge-primary badge-pill"><?= !empty($user->getFriends()->getUserId()) ? 'в друзьях' : 'не в друзьях' ?></span>
        </a>
    <?php } ?>
</div>