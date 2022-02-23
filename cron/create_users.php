<?php
//$document_root = '/home/web/vm-24c1f235.na4u.ru/www';
$_SERVER['DOCUMENT_ROOT'] = '/home/web/vm-24c1f235.na4u.ru/www';


include_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';


use \app\lib\Repository\User\Model\UsersModel;
use \app\lib\Repository\User\UsersRepository;

$csvFile = file('../db/migrations/users_test.csv');
$data = [];

$keys = str_getcsv($csvFile[0]);
$name = $keys[0];
$surName = $keys[1];

foreach ($csvFile as $line) {
    $fields = str_getcsv($line);

    $data[$name][] = $fields[0];
    $data[$surName][] = $fields[1];
}

$usersRepositury = new UsersRepository();

for($i=0; $i<2; $i++) {
    $randName = rand(0, count($data[$name])-1);
    $randSurname = rand(0, count($data[$surName])-1);

    $users = UsersModel::setMap([
        'login' => $data[$name][$randName],
        'password' => '123456',
        'first_name' => $data[$name][$randName],
        'sur_name' => $data[$surName][$randSurname],
        'age' => 20,
        'city' => "test"
    ]);


    $usersRepositury->saveUser($users);
}

echo 'пользователи созданы';

//echo "<pre>";
//print_r($data);
//echo "</pre>";

//echo "<pre>";
//print_r(rand(0, count($data[$name])));
//echo "</pre>";

