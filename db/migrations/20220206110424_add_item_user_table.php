<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddItemUserTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('users');
        $table->insert([
            [
                'created' => date('d.m.Y'),
                'login' => 'user',
                'password' => md5('123123'),
                'first_name' => 'Александр',
                'sur_name' => 'Иванов',
                'age' => 18,
                'city' => 'Екатеринбург',
                'interest' => 'пинг-понг'
            ],
            [
                'created' => date('d.m.Y'),
                'login' => 'Пользователь 1',
                'password' => md5('123123'),
                'first_name' => 'Иван',
                'sur_name' => 'Иванов',
                'age' => 18,
                'city' => 'Орел',
                'interest' => 'футбол'
            ],
            [
                'created' => date('d.m.Y'),
                'login' => 'Пользователь2',
                'password' => md5('123123'),
                'first_name' => 'Егор',
                'sur_name' => 'Смирнов',
                'age' => 22,
                'city' => 'Москва',
                'interest' => 'пинг-понг'
            ],
            [
                'created' => date('d.m.Y'),
                'login' => 'Пользователь3',
                'password' => md5('123123'),
                'first_name' => 'Семен',
                'sur_name' => 'Слепаков',
                'age' => 30,
                'city' => 'Тверь',
                'interest' => 'картинг'
            ],
            [
                'created' => date('d.m.Y'),
                'login' => 'Пользователь4',
                'password' => md5('123123'),
                'first_name' => 'Елена',
                'sur_name' => 'Тверская',
                'age' => 18,
                'city' => 'Хабаровск',
                'interest' => 'пинг-понг'
            ]
        ])
        ->save();
    }
}
