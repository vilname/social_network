<?php

namespace app\api\v1;

use app\lib\Repository\User\Model\UserModel;
use app\lib\Services\User\UsersService;
use League\Route\Http\Exception\NotFoundException;
use Psr\Http\Message\ServerRequestInterface;

class Users
{
    public function authUser(): array
    {
        $params = json_decode(file_get_contents('php://input'), true);
        $userItems = UserModel::setMap($params['form']);
        $userService = new UsersService();

        return $userService->authUser($userItems);
    }

    public function registration(): ?array
    {
        $params = json_decode(file_get_contents('php://input'), true);
        $userItems = UserModel::setMap($params['form']);
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

    public function getUser()
    {
        $userService = new UsersService();
        $userService->getUserByLogin('логин');
    }
}