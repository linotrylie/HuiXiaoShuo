<?php
/**
 * AuthController.php
 * Linotrylie
 * 2024/4/2 - 10:30
 * @Description
 * 天下万般兵刃，唯过往伤人最深
 */

namespace app\novel\controller;

use app\service\AuthService;
use support\Request;

class AuthController
{
    protected $noNeedLogin = ['login','register'];
    public function login(Request $request)
    {
        try {
            if($request->method() == 'POST' && $request->expectsJson()) {
                $serv = new AuthService();
                return success($serv->login($request));
            }else{
                return blade_view('auth/login');
            }
        }catch (\Exception $exception) {
            return error([],$exception);
        }
    }

    public function logout(Request $request)
    {
        try {
            if($request->isAjax()) {
                $serv = new AuthService();
                return success($serv->logout($request));
            }
            return success([]);
        }catch (\Exception $exception) {
            return error([],$exception);
        }
    }

    public function register(Request $request)
    {
        try {
            if($request->method() == 'POST' && $request->expectsJson()) {
                $serv = new AuthService();
                return success($serv->register($request));
            }else{
                return blade_view('auth/register');
            }
        }catch (\Exception $exception) {
            return error([],$exception);
        }
    }
}