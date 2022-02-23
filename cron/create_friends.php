<?php

$_SERVER['DOCUMENT_ROOT'] = '/home/web/vm-24c1f235.na4u.ru/www';
include_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

use app\lib\Repository\User\UsersRepository;
use app\lib\Repository\Friends\Model\FriendsModel;
use app\lib\Repository\Friends\FriendsRepository;

$userRepository = new UsersRepository();
$userIds = array_keys($userRepository->getUsers());

$friendRepository = new FriendsRepository();

for($i=0; $i<300000; $i++) {
    $randUserId = rand(0, count($userIds)-1);
    $randFriendId = rand(0, count($userIds)-1);

//    echo '<pre>';
//    print_r([
//        $userIds[$randUserId], $userIds[$randFriendId]
//    ]);
//    echo '</pre>';

    $friendRepository->addFriend($userIds[$randUserId], $userIds[$randFriendId]);
}
