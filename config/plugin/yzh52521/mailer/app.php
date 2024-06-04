<?php

return [
    'enable' => true,
    'mailer' => [
        'scheme'   => 'smtp',// "smtps": using TLS, "smtp": without using TLS.
        'host'     => getenv('MAIL_HOST'), // 服务器地址
        'username' => getenv('MAIL_USERNAME'), //用户名
        'password' => getenv('mail_password'), // 密码
        'port'     => (int)getenv('MAIL_PORT'), // SMTP服务器端口号,一般为25
        'options'  => [], // See: https://symfony.com/doc/current/mailer.html#tls-peer-verification
        //'dsn'      => '',
    ],
    'from'   => [
        'address' => getenv('app_host'),
        'name'    => getenv('app_name'),
    ],
];
