<?php

namespace app\lib\Repository;

class Main
{
    const HOST = 'localhost';
    const DB_NAME = 'network';
    const LOGIN = 'root';
    const PASS = '';

    protected $db;

    public function __construct()
    {
        try {
            $this->db = new \PDO(
                sprintf('mysql:host=%s;dbname=%s', static::HOST, static::DB_NAME),
                static::LOGIN,
                static::PASS
            );
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    public function render()
    {
        extract(func_get_arg(1));

        ob_start();

        if (file_exists(func_get_arg(0))) {
            require func_get_arg(0);
        } else {
            echo 'Template not found!';
        }

        return ob_get_clean();
    }
}