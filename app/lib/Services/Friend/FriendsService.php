<?php

namespace app\lib\Services\Friend;

use app\lib\Repository\Friends\FriendsRepository;

class FriendsService
{
    public function changeStatusFriend(int $friendId, int $userId): int
    {
        $friendsRepository = new FriendsRepository();
        $friend = $friendsRepository->getFriend($friendId, $userId);

        if ($friend) {
            return $friendsRepository->deleteFriend($friendId, $userId);
        } else {
            return $friendsRepository->addFriend($friendId, $userId);
        }
    }
}