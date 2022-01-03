<?php

namespace app\lib\Repository;

class Main
{
    const HOST = 'mysql';
    const DB_NAME = 'net';
    const LOGIN = 'root';
    const PASS = 'root';

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

}