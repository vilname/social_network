<?php

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'network',
            'user' => 'root',
            'pass' => '',
            'port' => '3306',
            'charset' => 'UTF8MB4',
        ],
        'development' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'network',
            'user' => 'root',
            'pass' => '',
            'port' => '3306',
            'charset' => 'UTF8MB4',
        ],
        'testing' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'net',
            'user' => 'root',
            'pass' => '',
            'port' => '3306',
            'charset' => 'UTF8MB4',
        ]
    ],
    'version_order' => 'creation'
];
