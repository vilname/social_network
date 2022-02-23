<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddTestUsers extends AbstractMigration
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
    public function up()
    {
        $csvFile = file('users_test.csv');
        $data = [];

        $keys = str_getcsv($csvFile[0]);
        $name = $keys[0];
        $surName = $keys[1];

        foreach ($csvFile as $line) {
            $fields = str_getcsv($line);

            $data[$name][] = $fields[0];
            $data[$surName][] = $fields[1];
        }

        $rows = [];
        for($i=900000; $i<1000000; $i++) {
            $randName = rand(0, count($data[$name])-1);
            $randSurname = rand(0, count($data[$surName])-1);

            $rows[] = [
                'login' => 'test'.$i,
                'password' => '123456',
                'first_name' => $data[$name][$randName],
                'sur_name' => $data[$surName][$randSurname],
                'age' => 20,
                'city' => "test"
            ];
        }

        $table = $this->table('users');
        $table->insert($rows)->saveData();
    }

    public function down()
    {
//        $sql = 'DELETE FROM `users` WHERE `city` = "test"';
//        $this->execute($sql);
    }
}
