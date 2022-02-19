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
        $userRepository = new UsersRepository();

        if ($searchUsers) {
            return $this->findFriend($searchUsers);
        }

        $users = $userRepository->getUsers();
        return $this->findFriend($users);
    }

    public function getFriends(): array
    {
        return (new UsersRepository())->getFriends();
    }

    public function searchFriends(string $name, string $surName): array
    {
        return (new UsersRepository())->searchFriends($name, $surName);
    }

    /**
     * @param UsersModel[] $searchUsers
     */
    protected function findFriend(array $searchUsers): array
    {
        $userRepository = new UsersRepository();
        $authUserFriendIds = $userRepository->getFriendsAuthUser(array_keys($searchUsers));

        foreach ($authUserFriendIds as $userId) {
            if ($searchUsers[$userId]) {
                $friendsModel = new FriendsModel();
                $friendsModel->setFriendId($_SESSION['auth_user']['id']);
                $searchUsers[$userId]->setFriends($friendsModel);
            }
        }

        return $searchUsers;
    }
}
