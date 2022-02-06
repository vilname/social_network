<?php


namespace app\lib\Repository\Friends\Model;


class FriendsModel
{
    private int $user_id;
    private int $friend_id;

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getFriendId(): int
    {
        return $this->friend_id;
    }

    /**
     * @param int $friend_id
     */
    public function setFriendId(int $friend_id): void
    {
        $this->friend_id = $friend_id;
    }

    /**
     * @param array $data
     * @return static
     */
    public static function setMap(array $data): self
    {
        $o = new self;
        $o->setUserId($data['user_id']);
        $o->setFriendId($data['friend_id']);

        return $o;
    }
}