<?php


namespace app\lib\Repository\Friends;

use app\lib\Repository\Main;
use app\lib\Repository\Friends\Model\FriendsModel;

class FriendsRepository extends Main
{
    protected string $table = 'friends';

    public function deleteFriend(int $friendId, int $userId): int
    {
        $sth = $this->db->prepare("delete from $this->table where friend_id = :friendId and user_id = :userId");
        return $sth->execute([
            'friendId' => $friendId,
            'userId' => $userId
        ]);
    }

    public function addFriend(int $friendId, int $userId): int
    {
        $sth = $this->db->prepare("INSERT INTO $this->table SET friend_id = :friendId, user_id = :userId");
        return $sth->execute([
            'friendId' => $friendId,
            'userId' => $userId
        ]);
    }

    public function getFriend(int $friendId, int $userId): bool
    {
        $sth = $this->db->prepare("select * from `friends` where friend_id = :friendId and user_id = :userId");
        $sth->execute([
            'friendId' => $friendId,
            'userId' => $userId
        ]);

        if ($sth->rowCount()) {
            return true;
        }

        return false;
    }
}