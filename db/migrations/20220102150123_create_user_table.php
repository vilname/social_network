<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUserTable extends AbstractMigration
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
        $table->addColumn('created', 'datetime')
            ->addColumn('updated', 'datetime', ['null' => true])
            ->addColumn('login', 'string', ['limit' => 255])
            ->addColumn('password', 'string', ['limit' => 255])
            ->addColumn('first_name', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('sur_name', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('age', 'integer', ['null' => true])
            ->addColumn('city', 'string', ['limit' => 30, 'null' => true])
            ->addColumn('interest', 'text', ['null' => true])
            ->addIndex(['login'], ['unique' => true])
            ->create();
    }
}
