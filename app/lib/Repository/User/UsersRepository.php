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

    public function getUsers()
    {
        $authUserid = $_SESSION['auth_user']['id'];

        $sth = $this->db->prepare("SELECT * FROM `users`
                                                WHERE `id` != :authUserid");

        $sth->execute([
            'authUserid' => $authUserid
        ]);

        if (!$sth->rowCount()) {
            throw new Exception('Не найдено ни одного пользователя');
        }

        $users = [];
        while ($field = $sth->fetch(\PDO::FETCH_ASSOC)) {
            $users[$field['id']] = UsersModel::setMap($field);
        }

        return $users;
    }

    public function getFriendsAuthUser(?array $userFriendsIds)
    {
//        $authUserid = $_SESSION['auth_user']['id'];

        $sql = "SELECT users.*, friends.user_id as user_id FROM `users` 
                                                JOIN `friends` ON users.id = friends.friend_id";

        $sqlParams = [
//            'authUserid' => $authUserid
        ];

        if ($userFriendsIds) {
            $sql .= sprintf("AND friend_id IN (%s)", implode(',', $userFriendsIds));
        }

        $sth = $this->db->prepare($sql);
        $sth->execute($sqlParams);

        if (!$sth->rowCount()) {
            throw new Exception('Не найдено ни одного друга');
        }

        $friendsIds = [];
        while ($field = $sth->fetch(\PDO::FETCH_ASSOC)) {
            $friendsIds[] = $field['friend_id'];
        }

        return array_unique($friendsIds);
    }

    /**
     * @return UsersModel[]
     */
    public function getFriends(): array
    {
        $authUserid = $_SESSION['auth_user']['id'];

        $sql = "SELECT users.*, friends.user_id as user_id FROM `users`
                                                JOIN `friends` ON users.id = friends.friend_id
                                                WHERE users.id != :authUserid AND friends.user_id = :authUserid";

        $sth = $this->db->prepare($sql);
        $sth->execute([
            'authUserid' => $authUserid
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

    public function searchFriends(string $firstName, string $surName): array
    {
//        $authUserid = $_SESSION['auth_user']['id'];

        $sql = sprintf("SELECT * FROM `users` WHERE first_name LIKE '%s' AND sur_name LIKE '%s'", $firstName, $surName);
        $sth = $this->db->prepare($sql);

        $sth->execute();

//        $sth->execute([
//            'authUserid' => $authUserid,
////            'firstName' => $firstName.'%',
////            'surName' => $surName.'%'
//        ]);

        if (!$sth->rowCount()) {
            throw new Exception('Не найдено ни одного пользователя');
        }

        $users = [];
        while ($field = $sth->fetch(\PDO::FETCH_ASSOC)) {
            $users[$field['id']] = UsersModel::setMap($field);
        }

        return $users;
    }
}
