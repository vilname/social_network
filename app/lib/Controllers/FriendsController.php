<?php


namespace app\lib\Controllers;

use app\lib\Services\Friend\FriendsService;

class FriendsController
{
    public function changeStatusFriend(int $friendId, int $userId): int
    {
        $friendsService = new FriendsService();
        return $friendsService->changeStatusFriend($friendId, $userId);
    }
}