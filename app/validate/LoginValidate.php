<?php

namespace app\api\validate;

use think\Validate;

class LoginValidate extends Validate
{
    protected $rule
        = [

            'password' => ['require', 'max' => 16],
            'username' => ['require', 'max' => 16,'regex'=>'/^[\w-]{4,16}$/'],
            'captcha' => ['require', 'max' => 8,'regex'=>'/^[A-Za-z0-9]+$/'],
        ];

    protected $message
        = [
            'password.require' => '密码必须',
            'password.max' => '密码最多不能超过16个字符',
            'username.max' => '用户名最多不能超过16个字符',
            'captcha.max' => '验证码最多不能超过8个字符',
            'username.require' => '用户名必须',
            'captcha.require' => '验证码必须',
            'captcha.regex' => '验证码不合法',
            'username.regex' => '用户名不合法',
        ];
}