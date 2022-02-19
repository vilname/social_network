<?php

namespace app\lib\Services\User;

use app\lib\Repository\Friends\Model\FriendsModel;
use app\lib\Repository\Main;
use app\lib\Repository\User\Model\UsersModel;
use app\lib\Repository\User\UsersRepository;

class UsersService
{
    public function getUserByLogin(string $login): ?UsersModel
    {
        try {
            $user = (new UsersRepository())->getUserByLogin($login);
        } catch (\Exception $e) {
            $user = null;
        }

        return $user;
    }

    public function saveUser(UsersModel $user): int
    {
        return (new UsersRepository())->saveUser($user);
    }

    public function editUser(UsersModel $user): int
    {
        return (new UsersRepository())->editUser($user);
    }

    public function authUser(UsersModel $user): array
    {
        return (new UsersRepository())->authUser($user);
    }

    /**
     * @param UsersModel[]|null $searchUsers
     * @return UsersModel[]
     */
    public function getOtherUsers(? array $searchUsers): array
    {
        if ($searchUsers) {
            $authUserFriends = (new UsersRepository())->getFriends(array_keys($searchUsers));
            foreach ($authUserFriends as $userId => $fields) {
                if ($searchUsers[$userId]) {
                    $searchUsers[$userId] = $fields;
                }
            }

            return (new UsersRepository())->getFriends(array_keys($searchUsers));
        }

        return (new UsersRepository())->getOtherUsers();
    }

    public function getFriends(): array
    {
        return (new UsersRepository())->getFriends();
    }

    public function searchFriends(string $name, string $surName): array
    {
        return (new UsersRepository())->searchFriends($name, $surName);
    }
}
