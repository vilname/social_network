<?php

namespace app\lib\Services\User;

use app\lib\Repository\Friends\Model\FriendsModel;
use app\lib\Repository\User\Model\UsersModel;
use app\lib\Repository\User\UsersRepository;

class UsersService
{
    protected $usersRepository;

    public function __construct()
    {
        $this->usersRepository = new UsersRepository();
    }

    public function getUserByLogin(string $login): ?UsersModel
    {
        try {
            $user = $this->usersRepository->getUserByLogin($login);
        } catch (\Exception $e) {
            $user = null;
        }

        return $user;
    }

    public function saveUser(UsersModel $user): int
    {
        return $this->usersRepository->saveUser($user);
    }

    public function editUser(UsersModel $user): int
    {
        return $this->usersRepository->editUser($user);
    }

    public function authUser(UsersModel $user): array
    {
        return $this->usersRepository->authUser($user);
    }

    /**
     * @param UsersModel[]|null $searchUsers
     * @return UsersModel[]
     */
    public function getOtherUsers(? array $searchUsers): array
    {
        if ($searchUsers) {
            return $this->findFriend($searchUsers);
        }

        $users = $this->usersRepository->getUsers();
        return $this->findFriend($users);
    }

    public function getFriends(): array
    {
        return $this->usersRepository->getFriends();
    }

    public function searchFriends(string $name, string $surName): array
    {
        return $this->usersRepository->searchFriends($name, $surName);
    }

    /**
     * @param UsersModel[] $searchUsers
     */
    protected function findFriend(array $searchUsers): array
    {
        $authUserFriendIds = $this->usersRepository->getFriendsAuthUser(array_keys($searchUsers));

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
