<?php

namespace app\validate;

use think\Validate;

class LogupValidate extends Validate
{
    protected $rule
        = [
            'email' => ['require', 'email', 'max' => 126],
            'password' => ['require', 'max' => 16],
            'username' => ['require', 'max' => 16,'regex'=>'/^[\w-]{4,16}$/'],
            'captcha' => ['require', 'max' => 8,'regex'=>'/^[A-Za-z0-9]+$/'],
            'emailCaptcha' => ['require', 'max' => 8,'regex'=>'/^[A-Za-z0-9]+$/'],
            'confirmPassword' => ['require', 'max' => 16, 'confirm' => 'password'],
        ];

    protected $message
        = [
            'email.require' => '邮箱地址必须',
            'email.max' => '邮箱地址最多不能超过126个字符',
            'email.email' => '邮箱地址格式不正确',
            'password.require' => '密码必须',
            'password.max' => '密码最多不能超过16个字符',
            'username.max' => '用户名最多不能超过16个字符',
            'captcha.max' => '验证码最多不能超过8个字符',
            'emailCaptcha.max' => '验证码最多不能超过8个字符',
            'confirmPassword.require' => '确认密码必须',
            'username.require' => '用户名必须',
            'captcha.require' => '验证码必须',
            'emailCaptcha.require' => '邮件验证码必须',
            'captcha.regex' => '验证码不合法',
            'emailCaptcha.regex' => '邮件验证码不合法',
            'username.regex' => '用户名不合法',
            'confirmPassword.confirm' => '确认密码与密码不一致',
        ];
}