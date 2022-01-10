<?php

namespace app\lib\Repository\User;

use app\lib\Repository\Main;
use app\lib\Repository\User\Model\UserModel;
use League\Route\Http\Exception\NotFoundException;

class UsersRepository extends Main
{
    public function getUserByLogin(string $login): ?UserModel
    {
        $sth = $this->db->prepare("SELECT * FROM `users` WHERE `login` = :login");

        $sth->execute([
            'login' => $login
        ]);

        if (!$sth->rowCount()) {
            throw new NotFoundException('Пользователь не найден');
        }

        return UserModel::setMap($sth->fetch(\PDO::FETCH_ASSOC));

    }

    public function saveUser(UserModel $user): int
    {
        $sth = $this->db->prepare("INSERT INTO `users` 
                                            SET `created` = :created,
                                                `login` = :login, 
                                                `password` = :password,
                                                `first_name` = :first_name,
                                                `sur_name` = :sur_name,
                                                `age` = :age,
                                                `city` = :city,
                                                `interest` = :interest");

        $sth->execute([
            'created' => date('Y-m-d'),
            'login' => $user->getLogin(),
            'password' => md5($user->getPassword()),
            'first_name' => $user->getFirstName(),
            'sur_name' => $user->getSurName(),
            'age' => $user->getAge(),
            'city' => $user->getCity(),
            'interest' => $user->getInterest()
        ]);

        // Получаем id вставленной записи
        return $this->db->lastInsertId();
    }

    public function authUser(UserModel $user)
    {
        $userBase = $this->getUserByLogin($user->getLogin());

        if (
            $userBase->getLogin() === $user->getLogin()
            && $userBase->getPassword() === md5($user->getPassword())
        ) {
            $_COOKIE['PHPSESSID'] = session_id();
            $_SESSION['auth_user'] = UserModel::setMapArray($userBase);

            return [
                'success' => 'авторизация успешна'
            ];
        } else {
            return [
                'error' => 'введен неверный логин или пароль'
            ];
        }


    }
}