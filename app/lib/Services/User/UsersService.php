<?php

namespace app\lib\Services\User;

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

    public function getOtherUsers(int $userId): array
    {
        return (new UsersRepository())->getOtherUsers($userId);
    }

    public function getFriends(int $userId): array
    {
        return (new UsersRepository())->getFriends($userId);
    }
}