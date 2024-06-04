<?php
/**
 * @author Linotrylie
 * @date 2024-02-19
 * 数据迁移配置文件
 * 采用robmorgan/phinx数据库迁移库
 * 详细使用可以去看官方中文文档
 * https://tsy12321.gitbooks.io/phinx-doc/content/
 * 生成迁移文件 php vendor/bin/phinx create 文件名
 * 生成种子文件  php vendor/bin/phinx seed:create 文件名
 * 运行迁移文件 php vendor/bin/phinx migrate
 */
return [
    "paths" => [
        "migrations" => "database/migrations",
        "seeds" => "database/seeds"
    ],
    "environments" => [
        "default_migration_table" => "phinxlog",
        "default_environment" => "dev",
        "dev" => [
            "adapter"     => 'mysql',
            'host'        => '127.0.0.1',
            'port'        => 3306,
            'name'        => 'huixiaoshuo',
            'user'    => 'root',
            'pass'    => 'root',
            "charset" => "utf8"
        ],
        "pro" => [
            "adapter"     => 'mysql',
            'host'        => '154.12.37.144',
            'port'        => 3306,
            'name'        => 'huixiaoshuo',
            'user'    => 'huixiaoshuo',
            'pass'    => 'nFFzZsDxkrys3sCW',
            "charset" => "utf8"
        ]
    ]
];