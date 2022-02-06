<?php

namespace app\lib\Repository\User;

use app\lib\Repository\Friends\Model\FriendsModel;
use app\lib\Repository\Main;
use app\lib\Repository\User\Model\UsersModel;
use Symfony\Component\Config\Definition\Exception\Exception;

class UsersRepository extends Main
{
    public function getUserByLogin(string $login): ?UsersModel
    {
        $sth = $this->db->prepare("SELECT * FROM `users` WHERE `login` = :login");

        $sth->execute([
            'login' => $login
        ]);

        if (!$sth->rowCount()) {
            throw new Exception('Пользователь не найден');
        }

        return UsersModel::setMap($sth->fetch(\PDO::FETCH_ASSOC));

    }

    public function saveUser(UsersModel $user): int
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

    public function editUser(UsersModel $user): int
    {
        $sth = $this->db->prepare("UPDATE `users` 
                                            SET `updated` = :updated,
                                                `login` = :login,
                                                `first_name` = :first_name,
                                                `sur_name` = :sur_name,
                                                `age` = :age,
                                                `city` = :city,
                                                `interest` = :interest
                                            WHERE `id` = :id");


        return $sth->execute([
            'id' => $user->getId(),
            'updated' => date('Y-m-d'),
            'login' => $user->getLogin(),
            'first_name' => $user->getFirstName(),
            'sur_name' => $user->getSurName(),
            'age' => $user->getAge(),
            'city' => $user->getCity(),
            'interest' => $user->getInterest()
        ]);
    }

    public function authUser(UsersModel $user)
    {
        $userBase = $this->getUserByLogin($user->getLogin());

        if (
            $userBase->getLogin() === $user->getLogin()
            && $userBase->getPassword() === md5($user->getPassword())
        ) {
            $user = UsersModel::setMapArray($userBase);

            $_SESSION['auth_user'] = [
                'id' => $user['id'],
                'login' => $user['login'],
                'first_name' =>  $user['first_name']
            ];

            return [
                'success' => 'авторизация успешна'
            ];
        } else {
            return [
                'error' => 'введен неверный логин или пароль'
            ];
        }
    }

    public function getOtherUsers(int $userId): array
    {
        $sth = $this->db->prepare("SELECT *, null as user_id FROM `users`
                                                WHERE `id` != :id 
                                        UNION DISTINCT 
                                            SELECT users.*, friends.user_id as user_id FROM `users` 
                                                JOIN `friends` ON users.id = friends.friend_id 
                                                WHERE users.id != :id AND friends.user_id = :id");

        $sth->execute([
            'id' => $userId
        ]);

        if (!$sth->rowCount()) {
            throw new Exception('Не найдено ни одного пользователя');
        }

        $users = [];
        while ($field = $sth->fetch(\PDO::FETCH_ASSOC)) {
            $friendsModel = new FriendsModel();
            $friendsModel->setUserId($field['user_id'] ?? 0);
            $field['friends'] = $friendsModel;
            $users[$field['id']] = UsersModel::setMap($field);
        }

        return $users;
    }

    public function getFriends(int $userId): array
    {
        $sth = $this->db->prepare("SELECT users.*, friends.user_id as user_id FROM `users` 
                                                JOIN `friends` ON users.id = friends.friend_id 
                                                WHERE users.id != :id AND friends.user_id = :id");

        $sth->execute([
            'id' => $userId
        ]);

        if (!$sth->rowCount()) {
            throw new Exception('Не найдено ни одного пользователя');
        }

        $users = [];
        while ($field = $sth->fetch(\PDO::FETCH_ASSOC)) {
            $friendsModel = new FriendsModel();
            $friendsModel->setUserId($field['user_id'] ?? 0);
            $field['friends'] = $friendsModel;
            $users[$field['id']] = UsersModel::setMap($field);
        }

        return $users;
    }
}