<?php

namespace app\lib\Controllers;

use app\lib\Repository\User\Model\UsersModel;
use app\lib\Services\User\UsersService;

class UsersController
{
    public function login(): array
    {
        $userItems = UsersModel::setMap($_POST);
        $userService = new UsersService();

        return $userService->authUser($userItems);
    }

    public function registration()
    {
        $userItems = UsersModel::setMap($_POST);
        $userService = new UsersService();

        $user = $userService->getUserByLogin($userItems->getLogin());

        if ($user) {
            return [
                "error" => "Пользователь с таким логином '{$user->getLogin()}' уже существует"
            ];
        }

        if ($userService->saveUser($userItems)) {
            return [
                "success" => "Пользователь '{$userItems->getLogin()}' успешно зарегистрирован"
            ];
        }

        return null;
    }

    public function logout($params) {
        if ($params['logout'] == 'yes') {
            unset($_SESSION['auth_user']);
        }
    }

    public function editProfile($userField): array
    {
        $userItems = UsersModel::setMap($userField);
        $userService = new UsersService();

        $user = $userService->getUserByLogin($userItems->getLogin());

        if ($user && $userItems->getId() !== $user->getId()) {
            return [
                "error" => "Пользователь с таким логином '{$user->getLogin()}' уже существует"
            ];
        }

        $userItems->setPassword($user->getPassword());
        if ($userService->editUser($userItems)) {
            return [
                "success" => "Профиль пользователя '{$userItems->getLogin()}' успешно изменен"
            ];
        }

        return [
            'error' => 'При изменении профиля произошла ошибка'
        ];
    }

    public function getUser(string $login): UsersModel
    {
        $userService = new UsersService();
        return $userService->getUserByLogin($login);
    }

    public function getOtherUsers(int $userId)
    {
        $userService = new UsersService();
        return $userService->getOtherUsers($userId);
    }

    public function getFriends(int $userId)
    {
        $userService = new UsersService();
        return $userService->getFriends($userId);
    }
}